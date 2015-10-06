<?php

namespace Emojione;

/**
 * Client for Emojione
 */

class Client implements ClientInterface
{
    public $ascii = false; // convert ascii smileys?
    public $unicodeAlt = true; // use the unicode char as the alt attribute (makes copy and pasting the resulting text better)
    public $imageType = 'png';
    public $cacheBustParam = '?v=1.2.4';
    public $sprites = false;
    public $imagePathPNG = '//cdn.jsdelivr.net/emojione/assets/png/';
    public $imagePathSVG = '//cdn.jsdelivr.net/emojione/assets/svg/';
    public $imagePathSVGSprites = './../../assets/sprites/emojione.sprites.svg';
    public $unicode_replaceWith = false;
    public $ignoredRegexp = '<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>';
    public $unicodeRegexp = '([#0-9](?>\\xEF\\xB8\\x8F)?\\xE2\\x83\\xA3|\\xC2[\\xA9\\xAE]|\\xE2..(?>\\xEF\\xB8\\x8F)?|\\xE3(?>\\x80[\\xB0\\xBD]|\\x8A[\\x97\\x99])(?>\\xEF\\xB8\\x8F)?|\\xF0\\x9F(?>[\\x80-\\x86].(?>\\xEF\\xB8\\x8F)?|\\x87.\\xF0\\x9F\\x87.|..))';
    public $shortcodeRegexp = ':([-+\\w]+):';

    protected $ruleset = null;

    public function __construct(RulesetInterface $ruleset = null)
    {
        if ( ! is_null($ruleset) )
        {
            $this->ruleset = $ruleset;
        }
    }

    // ##########################################
    // ######## core methods
    // ##########################################

    /**
     * First pass changes unicode characters into emoji markup.
     * Second pass changes any shortnames into emoji markup.
     *
     * @param   string  $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function toImage($string)
    {
        $string = $this->unicodeToImage($string);
        $string = $this->shortnameToImage($string);
        return $string;
    }

    /**
     * Uses toShort to transform all unicode into a standard shortname
     * then transforms the shortname into unicode.
     * This is done for standardization when converting several unicode types.
     *
     * @param   string  $string The input string.
     * @return  string  String with standardized unicode.
     */
    public function unifyUnicode($string)
    {
        $string = $this->toShort($string);
        $string = $this->shortnameToUnicode($string);
        return $string;
    }

    /**
     * This will output unicode from shortname input.
     * If Client/$ascii is true it will also output unicode from ascii.
     * This is useful for sending emojis back to mobile devices.
     *
     * @param   string  $string The input string.
     * @return  string  String with unicode replacements.
     */
    public function shortnameToUnicode($string)
    {
        $string = preg_replace_callback('/'.$this->ignoredRegexp.'|('.$this->shortcodeRegexp.')/Si', array($this, 'shortnameToUnicodeCallback'), $string);

        if($this->ascii)
        {
            $ruleset = $this->getRuleset();
            $asciiRegexp = $ruleset->getAsciiRegexp();

            $string = preg_replace_callback('/'.$this->ignoredRegexp.'|((\\s|^)'.$asciiRegexp.'(?=\\s|$|[!,.?]))/S', array($this, 'asciiToUnicodeCallback'), $string);
        }

        return $string;
    }

    /**
     * This will replace shortnames with their ascii equivalent.
     * ex. :wink: --> ;^)
     * This is useful for systems that don't support unicode or images.
     *
     * @param   string  $string The input string.
     * @return  string  String with ascii replacements.
     */
    public function shortnameToAscii($string)
    {
        $string = preg_replace_callback('/'.$this->ignoredRegexp.'|('.$this->shortcodeRegexp.')/Si', array($this, 'shortnameToAsciiCallback'), $string);

        return $string;
    }

    /**
     * This will output image markup (for png or svg) from shortname input.
     *
     * @param   string  $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function shortnameToImage($string)
    {
        $string = preg_replace_callback('/'.$this->ignoredRegexp.'|('.$this->shortcodeRegexp.')/Si', array($this, 'shortnameToImageCallback'), $string);

        if($this->ascii)
        {
            $ruleset = $this->getRuleset();
            $asciiRegexp = $ruleset->getAsciiRegexp();

            $string = preg_replace_callback('/'.$this->ignoredRegexp.'|((\\s|^)'.$asciiRegexp.'(?=\\s|$|[!,.?]))/S', array($this, 'asciiToImageCallback'), $string);
        }

        return $string;
    }

    /**
     * This will return the shortname from unicode input.
     *
     * @param   string  $string The input string.
     * @return  string  shortname
     */
    public function toShort($string)
    {
        return preg_replace_callback('/'.$this->ignoredRegexp.'|'.$this->unicodeRegexp.'/S', array($this, 'toShortCallback'), $string);
    }

    /**
     * This will output image markup (for png or svg) from unicode input.
     *
     * @param   string  $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function unicodeToImage($string)
    {
        return preg_replace_callback('/'.$this->ignoredRegexp.'|'.$this->unicodeRegexp.'/S', array($this, 'unicodeToImageCallback'), $string);
    }

    // ##########################################
    // ######## preg_replace callbacks
    // ##########################################

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Ascii replacement result.
     */
    public function shortnameToAsciiCallback($m)
    {
        if((!is_array($m)) || (!isset($m[1])) || (empty($m[1])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = $this->getRuleset();
            $shortcode_replace = $ruleset->getShortcodeReplace();
            $ascii_replace = $ruleset->getAsciiReplace();

            $aflipped = array_flip($ascii_replace);

            $shortname = $m[0];

            if(!isset($shortcode_replace[$shortname]))
            {
                return $m[0];
            }

            $unicode = strtolower($shortcode_replace[$shortname]);

            return isset($aflipped[$unicode]) ? $aflipped[$unicode] : $m[0];
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Unicode replacement result.
     */
    public function shortnameToUnicodeCallback($m)
    {
        if((!is_array($m)) || (!isset($m[1])) || (empty($m[1])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = $this->getRuleset();
            $unicode_replace = $ruleset->getUnicodeReplace();

            $flipped = array_flip($unicode_replace);

            $shortname = $m[1];

            if(!isset($flipped[$shortname]))
            {
                return $m[0];
            }


            $unicode = $flipped[$shortname];
            return $unicode;
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Image HTML replacement result.
     */
    public function shortnameToImageCallback($m)
    {
        if((!is_array($m)) || (!isset($m[1])) || (empty($m[1])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = $this->getRuleset();
            $shortcode_replace = $ruleset->getShortcodeReplace();

            $shortname = $m[1];

            if(!isset($shortcode_replace[$shortname]))
            {
                return $m[0];
            }


            $unicode = $shortcode_replace[$shortname];
            $filename = strtoupper($unicode);

            if($this->unicodeAlt)
            {
                $alt = $this->convert($unicode);
            }
            else
            {
                $alt = $shortname;
            }

            if($this->imageType == 'png')
            {
                if($this->sprites)
                {
                    return '<span class="emojione-'.strtoupper($unicode).'" title="'.htmlspecialchars($shortname).'">'.$alt.'</span>';
                }
                else
                {
                    return '<img class="emojione" alt="'.$alt.'" src="'.$this->imagePathPNG.$filename.'.png'.$this->cacheBustParam.'"/>';
                }
            }

            if($this->sprites)
            {
                return '<svg class="emojione"><description>'.$alt.'</description><use xlink:href="'.$this->imagePathSVGSprites.'#emoji-'.strtoupper($unicode).'"></use></svg>';
            }
            else
            {
                return '<object class="emojione" data="'.$this->imagePathSVG.$filename.'.svg'.$this->cacheBustParam.'" type="image/svg+xml" standby="'.$alt.'">'.$alt.'</object>';
            }
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Unicode replacement result.
     */
    public function asciiToUnicodeCallback($m)
    {
        if((!is_array($m)) || (!isset($m[3])) || (empty($m[3])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = $this->getRuleset();
            $ascii_replace = $ruleset->getAsciiReplace();

            $shortname = $m[3];
            $unicode = $ascii_replace[$shortname];
            return $m[2].$this->convert($unicode);
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Image HTML replacement result.
     */
    public function asciiToImageCallback($m)
    {
        if((!is_array($m)) || (!isset($m[3])) || (empty($m[3])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = $this->getRuleset();
            $ascii_replace = $ruleset->getAsciiReplace();

            $shortname = html_entity_decode($m[3]);
            $unicode = $ascii_replace[$shortname];

            // unicode char or shortname for the alt tag? (unicode is better for copying and pasting the resulting text)
            if($this->unicodeAlt)
            {
                $alt = $this->convert($unicode);
            }
            else
            {
                $alt = htmlspecialchars($shortname);
            }

            if($this->imageType == 'png')
            {
                if($this->sprites)
                {
                    return $m[2].'<span class="emojione-'.strtoupper($unicode).'" title="'.htmlspecialchars($shortname).'">'.$alt.'</span>';
                }
                else
                {
                    return $m[2].'<img class="emojione" alt="'.$alt.'" src="'.$this->imagePathPNG.strtoupper($unicode).'.png'.$this->cacheBustParam.'"/>';
                }
            }

            if($this->sprites)
            {
                return $m[2].'<svg class="emojione"><description>'.$alt.'</description><use xlink:href="'.$this->imagePathSVGSprites.'#emoji-'.strtoupper($unicode).'"></use></svg>';
            }
            else
            {
                return $m[2].'<object class="emojione" data="'.$this->imagePathSVG.strtoupper($unicode).'.svg'.$this->cacheBustParam.'" type="image/svg+xml" standby="'.$alt.'">'.$alt.'</object>';
            }
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  shortname result
     */
    public function toShortCallback($m)
    {
        if((!is_array($m)) || (!isset($m[1])) || (empty($m[1])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = $this->getRuleset();
            $unicode_replace = $ruleset->getUnicodeReplace();

            $unicode = $m[1];

            if(!isset($unicode_replace[$unicode]))
            {
                $unicode = substr($m[1], 0, 4);

                if(!isset($unicode_replace[$unicode]))
                {
                    return $m[0];
                }
            }

            return $unicode_replace[$unicode];
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Image HTML replacement result.
     */
    public function unicodeToImageCallback($m)
    {
        if((!is_array($m)) || (!isset($m[1])) || (empty($m[1])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = $this->getRuleset();
            $shortcode_replace = $ruleset->getShortcodeReplace();
            $unicode_replace = $ruleset->getUnicodeReplace();

            $unicode = $m[1];

            if(!isset($unicode_replace[$unicode]))
            {
                $unicode = substr($m[1], 0, 4);

                if(!isset($unicode_replace[$unicode]))
                {
                    return $m[0];
                }
            }

            $shortname = $unicode_replace[$unicode];
            $filename = strtoupper($shortcode_replace[$shortname]);

            if($this->unicodeAlt)
            {
                $alt = $unicode;
            }
            else
            {
                $alt = $shortname;
            }

            if($this->imageType == 'png')
            {
                if($this->sprites)
                {
                    return '<span class="emojione-'.$filename.'" title="'.htmlspecialchars($shortname).'">'.$alt.'</span>';
                }
                else
                {
                    return '<img class="emojione" alt="'.$alt.'" src="'.$this->imagePathPNG.$filename.'.png'.$this->cacheBustParam.'"/>';
                }
            }

            if($this->sprites)
            {
                return '<svg class="emojione"><description>'.$alt.'</description><use xlink:href="'.$this->imagePathSVGSprites.'#emoji-'.$filename.'"></use></svg>';
            }
            else
            {
                return '<object class="emojione" data="'.$this->imagePathSVG.$filename.'.svg'.$this->cacheBustParam.'" type="image/svg+xml" standby="'.$alt.'">'.$alt.'</object>';
            }
        }
    }

    // ##########################################
    // ######## helper methods
    // ##########################################

    /**
     * Converts from unicode to hexadecimal NCR.
     *
     * @param   string  $unicode unicode character/s
     * @return  string  hexadecimal NCR
     * */
    public function convert($unicode)
    {
        if(stristr($unicode,'-'))
        {
            $pairs = explode('-',$unicode);
            return '&#x'.implode(';&#x',$pairs).';';
        }
        else
        {
            return '&#x'.$unicode.';';
        }
    }

    /**
     * Get the Ruleset
     *
     * @return RulesetInterface The Ruleset
     */
    public function getRuleset()
    {
        if ( $this->ruleset === null )
        {
            $this->ruleset = new Ruleset;
        }

        return $this->ruleset;
    }
}
