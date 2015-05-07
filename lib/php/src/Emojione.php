<?php

namespace Emojione;

class Emojione
{
    public static $ascii = false; // convert ascii smileys?
    public static $unicodeAlt = true; // use the unicode char as the alt attribute (makes copy and pasting the resulting text better)
    public static $imageType = 'png';
    public static $cacheBustParam = '?v=1.2.4';
    public static $sprites = false;
    public static $imagePathPNG = '//cdn.jsdelivr.net/emojione/assets/png/';
    public static $imagePathSVG = '//cdn.jsdelivr.net/emojione/assets/svg/';
    public static $imagePathSVGSprites = './../../assets/sprites/emojione.sprites.svg';
    public static $unicode_replaceWith = false;
    public static $ignoredRegexp = '<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>';
    public static $unicodeRegexp = '([#0-9](?>\\xEF\\xB8\\x8F)?\\xE2\\x83\\xA3|\\xC2[\\xA9\\xAE]|\\xE2..(?>\\xEF\\xB8\\x8F)?|\\xE3(?>\\x80[\\xB0\\xBD]|\\x8A[\\x97\\x99])(?>\\xEF\\xB8\\x8F)?|\\xF0\\x9F(?>[\\x80-\\x86].(?>\\xEF\\xB8\\x8F)?|\\x87.\\xF0\\x9F\\x87.|..))';
    public static $shortcodeRegexp = ':([-+\\w]+):';

    protected static $ruleset = null;

    private function __construct() {}

    // ##########################################
    // ######## core methods
    // ##########################################
    public static function toImage($string)
    {
        $string = self::unicodeToImage($string);
        $string = self::shortnameToImage($string);
        return $string;
    }

    // Uses toShort to transform all unicode into a standard shortname
    // then transforms the shortname into unicode
    // This is done for standardization when converting several unicode types
    public static function unifyUnicode($string)
    {
        $string = self::toShort($string);
        $string = self::shortnameToUnicode($string);
        return $string;
    }

    // will output unicode from shortname
    // useful for sending emojis back to mobile devices
    public static function shortnameToUnicode($string)
    {
        $string = preg_replace_callback('/'.self::$ignoredRegexp.'|('.self::$shortcodeRegexp.')/Si', 'static::shortnameToUnicodeCallback', $string);

        if(self::$ascii)
        {
            $ruleset = static::getRuleset();
            $asciiRegexp = $ruleset->getAsciiRegexp();

            $string = preg_replace_callback('/'.self::$ignoredRegexp.'|((\\s|^)'.$asciiRegexp.'(?=\\s|$|[!,\.]))/S', 'static::asciiToUnicodeCallback', $string);
        }

        return $string;
    }

    // Replace shortnames (:wink:) with Ascii equivalents ;^)
    // Useful for systems that dont support unicode nor images
    public static function shortnameToAscii($string)
    {
        $string = preg_replace_callback('/'.self::$ignoredRegexp.'|('.self::$shortcodeRegexp.')/Si', 'static::shortnameToAsciiCallback', $string);

        return $string;
    }

    public static function shortnameToImage($string)
    {
        $string = preg_replace_callback('/'.self::$ignoredRegexp.'|('.self::$shortcodeRegexp.')/Si', 'static::shortnameToImageCallback', $string);

        if(self::$ascii)
        {
            $ruleset = static::getRuleset();
            $asciiRegexp = $ruleset->getAsciiRegexp();

            $string = preg_replace_callback('/'.self::$ignoredRegexp.'|((\\s|^)'.$asciiRegexp.'(?=\\s|$|[!,\.]))/S', 'static::asciiToImageCallback', $string);
        }

        return $string;
    }

    public static function toShort($string)
    {
        return preg_replace_callback('/'.self::$ignoredRegexp.'|'.self::$unicodeRegexp.'/S', 'static::toShortCallback', $string);
    }

    public static function unicodeToImage($string)
    {
        return preg_replace_callback('/'.self::$ignoredRegexp.'|'.self::$unicodeRegexp.'/S', 'static::unicodeToImageCallback', $string);
    }

    // ##########################################
    // ######## preg_replace callbacks
    // ##########################################
    public static function shortnameToAsciiCallback($m)
    {
        if((!is_array($m)) || (!isset($m[1])) || (empty($m[1])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = static::getRuleset();
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

    public static function shortnameToUnicodeCallback($m)
    {
        if((!is_array($m)) || (!isset($m[1])) || (empty($m[1])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = static::getRuleset();
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

    public static function shortnameToImageCallback($m)
    {
        if((!is_array($m)) || (!isset($m[1])) || (empty($m[1])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = static::getRuleset();
            $shortcode_replace = $ruleset->getShortcodeReplace();

            $shortname = $m[1];

            if(!isset($shortcode_replace[$shortname]))
            {
                return $m[0];
            }


            $unicode = $shortcode_replace[$shortname];
            $filename = strtoupper($unicode);

            if(self::$unicodeAlt)
            {
                $alt = self::convert($unicode);
            }
            else
            {
                $alt = $shortname;
            }

            if(self::$imageType == 'png')
            {
                if(self::$sprites)
                {
                    return '<span class="emojione-'.strtoupper($unicode).'" title="'.htmlspecialchars($shortname).'">'.$alt.'</span>';
                }
                else
                {
                    return '<img class="emojione" alt="'.$alt.'" src="'.self::$imagePathPNG.$filename.'.png'.self::$cacheBustParam.'"/>';
                }
            }

            if(self::$sprites)
            {
                return '<svg class="emojione"><description>'.$alt.'</description><use xlink:href="'.self::$imagePathSVGSprites.'#emoji-'.strtoupper($unicode).'"></use></svg>';
            }
            else
            {
                return '<object class="emojione" data="'.self::$imagePathSVG.$filename.'.svg'.self::$cacheBustParam.'" type="image/svg+xml" standby="'.$alt.'">'.$alt.'</object>';
            }
        }
    }

    public static function asciiToUnicodeCallback($m)
    {
        if((!is_array($m)) || (!isset($m[3])) || (empty($m[3])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = static::getRuleset();
            $ascii_replace = $ruleset->getAsciiReplace();

            $shortname = $m[3];
            $unicode = $ascii_replace[$shortname];
            return $m[2].self::convert($unicode);
        }
    }

    public static function asciiToImageCallback($m)
    {
        if((!is_array($m)) || (!isset($m[3])) || (empty($m[3])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = static::getRuleset();
            $ascii_replace = $ruleset->getAsciiReplace();

            $shortname = html_entity_decode($m[3]);
            $unicode = $ascii_replace[$shortname];

            // unicode char or shortname for the alt tag? (unicode is better for copying and pasting the resulting text)
            if(self::$unicodeAlt)
            {
                $alt = self::convert($unicode);
            }
            else
            {
                $alt = htmlspecialchars($shortname);
            }

            if(self::$imageType == 'png')
            {
                if(self::$sprites)
                {
                    return $m[2].'<span class="emojione-'.strtoupper($unicode).'" title="'.htmlspecialchars($shortname).'">'.$alt.'</span>';
                }
                else
                {
                    return $m[2].'<img class="emojione" alt="'.$alt.'" src="'.self::$imagePathPNG.strtoupper($unicode).'.png'.self::$cacheBustParam.'"/>';
                }
            }

            if(self::$sprites)
            {
                return $m[2].'<svg class="emojione"><description>'.$alt.'</description><use xlink:href="'.self::$imagePathSVGSprites.'#emoji-'.strtoupper($unicode).'"></use></svg>';
            }
            else
            {
                return $m[2].'<object class="emojione" data="'.self::$imagePathSVG.strtoupper($unicode).'.svg'.self::$cacheBustParam.'" type="image/svg+xml" standby="'.$alt.'">'.$alt.'</object>';
            }
        }
    }

    public static function toShortCallback($m)
    {
        if((!is_array($m)) || (!isset($m[1])) || (empty($m[1])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = static::getRuleset();
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

    public static function unicodeToImageCallback($m)
    {
        if((!is_array($m)) || (!isset($m[1])) || (empty($m[1])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = static::getRuleset();
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

            if(self::$unicodeAlt)
            {
                $alt = $unicode;
            }
            else
            {
                $alt = $shortname;
            }

            if(self::$imageType == 'png')
            {
                if(self::$sprites)
                {
                    return '<span class="emojione-'.strtoupper($unicode).'" title="'.htmlspecialchars($shortname).'">'.$alt.'</span>';
                }
                else
                {
                    return '<img class="emojione" alt="'.$alt.'" src="'.self::$imagePathPNG.$filename.'.png'.self::$cacheBustParam.'"/>';
                }
            }

            if(self::$sprites)
            {
                return '<svg class="emojione"><description>'.$alt.'</description><use xlink:href="'.self::$imagePathSVGSprites.'#emoji-'.strtoupper($unicode).'"></use></svg>';
            }
            else
            {
                return '<object class="emojione" data="'.self::$imagePathSVG.$filename.'.svg'.self::$cacheBustParam.'" type="image/svg+xml" standby="'.$alt.'">'.$alt.'</object>';
            }
        }
    }

    // ##########################################
    // ######## helper methods
    // ##########################################
    public static function convert($unicode)
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
    protected static function getRuleset()
    {
        if ( static::$ruleset === null )
        {
            static::$ruleset = new Ruleset;
        }

        return static::$ruleset;
    }
}
