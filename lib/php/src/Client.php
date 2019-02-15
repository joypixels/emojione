<?php

namespace Emojione;

/**
 * Client for Emojione
 */

class Client implements ClientInterface
{
    public $ascii = false; // convert ascii smileys?
    public $riskyMatchAscii = false; // set true to match ascii without leading/trailing space char
    public $shortcodes = true; // convert shortcodes?
    public $unicodeAlt = true; // use the unicode char as the alt attribute (makes copy and pasting the resulting text better)
    public $emojiVersion = '4.5';
    public $emojiSize = '32'; //available sizes are '32', '64', and '128'
    public $greedyMatch = false;
    public $blacklistChars = '';
    public $sprites = false;
    public $spriteSize = '32'; // available sizes are '32' and '64'
    public $imagePathPNG = 'https://cdn.jsdelivr.net/emojione/assets';
    public $fileExtension = '.png';
    public $imageTitleTag = true;
    public $unicode_replaceWith = false;
    public $ignoredRegexp = '<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>';
    public $unicodeRegexp = '(?:[\x{1F3F3}|\x{1F3F4}]\x{FE0F}?\x{200D}?[\x{1F308}|\x{2620}]\x{FE0F}?)|(?:\x{1F441}\x{FE0F}?\x{200D}?\x{1F5E8}\x{FE0F}?)|(?:[\x{1f468}|\x{1f469}]\x{200d}\x{2764}\x{fe0f}?\x{200d}[\x{1f48b}\x{200d}]*[\x{1f468}|\x{1f469}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1F9B8}|\x{1F9B9}]+[\x{1F3FB}-\x{1F3FF}]?\x{200D}[\x{2640}-\x{2642}]?\x{FE0F}?)|(?:[\x{1F468}|\x{1F469}]+[\x{1F3FB}-\x{1F3FF}]?\x{200D}[\x{1F9B0}-\x{1F9B3}]+\x{FE0F}?)|[\x{0023}-\x{0039}]\x{FE0F}?\x{20e3}|(?:\x{1F3F4}[\x{E0060}-\x{E00FF}]{1,6})|[\x{1F1E0}-\x{1F1FF}]{2}|(?:[\x{1F468}|\x{1F469}]\x{FE0F}?[\x{1F3FB}-\x{1F3FF}]?\x{200D}?[\x{2695}|\x{2696}|\x{2708}|\x{1F4BB}|\x{1F4BC}|\x{1F527}|\x{1F52C}|\x{1F680}|\x{1F692}|\x{1F33E}|\x{1F3EB}|\x{1F3EC}|\x{1f373}|\x{1f393}|\x{1f3a4}|\x{1f3ed}|\x{1f3a8}]\x{FE0F}?)|[\x{1F468}-\x{1F469}\x{1F9D0}-\x{1F9DF}][\x{1F3FA}-\x{1F3FF}]?\x{200D}?[\x{2640}\x{2642}\x{2695}\x{2696}\x{2708}]?\x{FE0F}?|(?:[\x{1F9B5}|\x{1F9B6}]+[\x{1F3FB}-\x{1F3FF}]+)|(?:[\x{1f46e}\x{1F468}\x{1F469}\x{1f575}\x{1f471}-\x{1f487}\x{1F645}-\x{1F64E}\x{1F926}\x{1F937}]|[\x{1F460}-\x{1F482}\x{1F3C3}-\x{1F3CC}\x{26F9}\x{1F486}\x{1F487}\x{1F6A3}-\x{1F6B6}\x{1F938}-\x{1F93E}]|\x{1F46F})\x{FE0F}?[\x{1F3FA}-\x{1F3FF}]?\x{200D}?[\x{2640}\x{2642}]?\x{FE0F}?|(?:[\x{26F9}\x{261D}\x{270A}-\x{270D}\x{1F385}-\x{1F3CC}\x{1F442}-\x{1F4AA}\x{1F574}-\x{1F596}\x{1F645}-\x{1F64F}\x{1F6A3}-\x{1F6CC}\x{1F918}-\x{1F93E}]\x{FE0F}?[\x{1F3FA}-\x{1F3FF}])|(?:[\x{2194}-\x{2199}\x{21a9}-\x{21aa}]\x{FE0F}?|[\x{0023}-\x{002a}]|[\x{3030}\x{303d}]\x{FE0F}?|(?:[\x{1F170}-\x{1F171}]|[\x{1F17E}-\x{1F17F}]|\x{1F18E}|[\x{1F191}-\x{1F19A}]|[\x{1F1E6}-\x{1F1FF}])\x{FE0F}?|\x{24c2}\x{FE0F}?|[\x{3297}\x{3299}]\x{FE0F}?|(?:[\x{1F201}-\x{1F202}]|\x{1F21A}|\x{1F22F}|[\x{1F232}-\x{1F23A}]|[\x{1F250}-\x{1F251}])\x{FE0F}?|[\x{203c}\x{2049}]\x{FE0F}?|[\x{25aa}-\x{25ab}\x{25b6}\x{25c0}\x{25fb}-\x{25fe}]\x{FE0F}?|[\x{00a9}\x{00ae}]\x{FE0F}?|[\x{2122}\x{2139}]\x{FE0F}?|\x{1F004}\x{FE0F}?|[\x{2b05}-\x{2b07}\x{2b1b}-\x{2b1c}\x{2b50}\x{2b55}]\x{FE0F}?|[\x{231a}-\x{231b}\x{2328}\x{23cf}\x{23e9}-\x{23f3}\x{23f8}-\x{23fa}]\x{FE0F}?|\x{1F0CF}|[\x{2934}\x{2935}]\x{FE0F}?)|[\x{2700}-\x{27bf}]\x{FE0F}?|[\x{1F000}-\x{1F6FF}\x{1F900}-\x{1F9FF}]\x{FE0F}?|[\x{2600}-\x{26ff}]\x{FE0F}?|(?:[\x{1F466}-\x{1F469}]+\x{FE0F}?[\x{1F3FB}-\x{1F3FF}]?)|[\x{0030}-\x{0039}]\x{FE0F}';
    public $shortcodeRegexp = ':([-+\\w]+):';
    public $startTime = 0;
    public $endTime = 0;

    protected $ruleset = null;

    public function __construct(RulesetInterface $ruleset = null)
    {
        if ( ! is_null($ruleset) )
        {
            $this->ruleset = $ruleset;
        }

        $this->imagePathPNG = $this->imagePathPNG . '/' . $this->emojiVersion . '/png/' . $this->emojiSize . '/';
        $this->spriteSize = ($this->spriteSize == '32' || $this->spriteSize == '64') ? $this->spriteSize : '32';
    }

    // ##########################################
    // ######## core methods
    // ##########################################

    /**
     * First pass changes unicode characters into emoji shortnames.
     * Second pass changes shortnames into emoji markup.
     *
     * @param   string  $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function toImage($string)
    {
        //$string = $this->unicodeToImage($string);
        $string = $this->toShort($string);
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
        if ($this->shortcodes)
        {
            $string = preg_replace_callback('/'.$this->ignoredRegexp.'|('.$this->shortcodeRegexp.')/Si', array($this, 'shortnameToUnicodeCallback'), $string);
        }

        if ($this->ascii)
        {
            $ruleset = $this->getRuleset();
            $asciiRegexp = $ruleset->getAsciiRegexp();
            $asciiRX = ($this->riskyMatchAscii) ? '|(()'.$asciiRegexp.'())' : '|((\\s|^)'.$asciiRegexp.'(?=\\s|$|[!,.?]))';

            $string = preg_replace_callback('/'.$this->ignoredRegexp.$asciiRX.'/S', array($this, 'asciiToUnicodeCallback'), $string);
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
     * This will replace ascii with their shortname equivalent, it bases on reversed ::shortnameToAsciiCallback
     * ex. :) --> :slight_smile:
     * This is useful for systems that don't ascii emoji.
     *
     * @param   string  $string The input ascii.
     * @return  string  String with shortname replacements.
     */
    public function asciiToShortname($string)
    {
        $ruleset = $this->getRuleset();
        $asciiRegexp = $ruleset->getAsciiRegexp();
        $asciiRX = ($this->riskyMatchAscii) ? '|(()'.$asciiRegexp.'())' : '|((\\s|^)'.$asciiRegexp.'(?=\\s|$|[!,.?]))';

        return preg_replace_callback('/'.$this->ignoredRegexp.$asciiRX.'/S', array($this, 'asciiToShortnameCallback'), $string);
    }

    /**
     * This will output image markup from shortname input.
     *
     * @param   string  $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function shortnameToImage($string)
    {
        if ($this->shortcodes)
        {
            $string = preg_replace_callback('/'.$this->ignoredRegexp.'|('.$this->shortcodeRegexp.')/Si', array($this, 'shortnameToImageCallback'), $string);
        }

        if ($this->ascii)
        {
            $ruleset = $this->getRuleset();
            $asciiRegexp = $ruleset->getAsciiRegexp();
            $asciiRX = ($this->riskyMatchAscii) ? '|(()'.$asciiRegexp.'())' : '|((\\s|^)'.$asciiRegexp.'(?=\\s|$|[!,.?]))';

            $string = preg_replace_callback('/'.$this->ignoredRegexp.$asciiRX.'/S', array($this, 'asciiToImageCallback'), $string);
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
        return preg_replace_callback('/'.$this->ignoredRegexp.'|'.$this->unicodeRegexp.'/u', array($this, 'toShortCallback'), $string);
    }

    /**
     * This method has been deprecated as of 4.0
     *
     * @param   string  $string The input string.
     * @return  string  returns input string.
     */
    public function unicodeToImage($string)
    {
        return $string;
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
        if ((!is_array($m)) || (!isset($m[1])) || (empty($m[1])))
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

            if (!isset($shortcode_replace[$shortname]))
            {
                return $m[0];
            }

            $unicode = $shortcode_replace[$shortname][0];

            return isset($aflipped[$unicode]) ? $aflipped[$unicode] : $m[0];
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Unicode replacement result.
     */
    public function shortnameToUnicodeCallback($m)
    {
        if ((!is_array($m)) || (!isset($m[1])) || (empty($m[1]))) {
            return $m[0];
        }
        else {
            $ruleset = $this->getRuleset();
            $unicode_replace = $ruleset->getUnicodeReplace();
            $shortcode_replace = $ruleset->getShortcodeReplace();

            $shortname = strtolower($m[1]);

            if (!array_key_exists($shortname, $shortcode_replace)) {
                return $m[0];
            }

            $unicode = $shortcode_replace[$shortname][0];

            return $this->convert($unicode);
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Image HTML replacement result.
     */
    public function shortnameToImageCallback($m)
    {
        if ((!is_array($m)) || (!isset($m[1])) || (empty($m[1]))) {
            return $m[0];
        }
        else {
            $ruleset = $this->getRuleset();
            $shortcode_replace = $ruleset->getShortcodeReplace();

            $shortname = $m[1];

            if (!isset($shortcode_replace[$shortname]))
            {
                return $m[0];
            }

            $unicode = $shortcode_replace[$shortname][0];
            $filename = $shortcode_replace[$shortname][2];
            $category = (strpos($filename, '-1f3f') !== false) ? 'diversity' : $shortcode_replace[$shortname][3];
            $titleTag = $this->imageTitleTag ? 'title="'.htmlspecialchars($shortname).'"' : '';

            if ($this->unicodeAlt)
            {
                $alt = $this->convert($unicode);
            }
            else
            {
                $alt = $shortname;
            }

            if ($this->sprites)
            {
                return '<span class="emojione emojione-'.$this->spriteSize.'-'.$category.' _'.$filename.'" '.$titleTag.'>'.$alt.'</span>';
            }
            else
            {
                return '<img class="emojione" alt="'.$alt.'" '.$titleTag.' src="' . $this->imagePathPNG . $filename . $this->fileExtension . '"/>';
            }
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Unicode replacement result.
     */
    public function asciiToUnicodeCallback($m)
    {
        if ((!is_array($m)) || (!isset($m[3])) || (empty($m[3])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = $this->getRuleset();
            $ascii_replace = $ruleset->getAsciiReplace();
            $shortcode_replace = $ruleset->getShortcodeReplace();
            $ascii = $m[3];

            if ( empty($ascii_replace[$ascii]) )
            {
                return $m[3];
            }
            else
            {
                $shortname = $ascii_replace[$ascii];
                $uc_output = $shortcode_replace[$shortname][0];
                return $m[2].$this->convert($uc_output);
            }
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Shortname replacement result.
     */
    public function asciiToShortnameCallback($m)
    {
        if ((!is_array($m)) || (!isset($m[3])) || (empty($m[3])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = $this->getRuleset();
            $ascii_replace = $ruleset->getAsciiReplace();

            $shortcode_replace = array_flip(array_reverse($ruleset->getShortcodeReplace()));
            $shortname = $m[3];

            if ( empty($ascii_replace[$shortname]) )
            {
                return $m[3];
            }
            else
            {
                $unicode = $ascii_replace[$shortname];
                return $m[2].$shortcode_replace[$unicode];
            }
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Image HTML replacement result.
     */
    public function asciiToImageCallback($m)
    {
        if ((!is_array($m)) || (!isset($m[3])) || (empty($m[3])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = $this->getRuleset();
            $ascii_replace = $ruleset->getAsciiReplace();
            $shortcode_replace = $ruleset->getShortcodeReplace();

            $ascii = html_entity_decode($m[3]);

            if ( empty($ascii_replace[$ascii]) )
            {
                return $m[3];
            }
            else
            {
                $shortname = $ascii_replace[$ascii];
                $filename = $shortcode_replace[$shortname][2];
                $uc_output = $shortcode_replace[$shortname][0];
                $category = (strpos($filename, '-1f3f') !== false) ? 'diversity' : $shortcode_replace[$shortname][3];
                $titleTag = $this->imageTitleTag ? 'title="'.htmlspecialchars($shortname).'"' : '';

                // unicode char or shortname for the alt tag? (unicode is better for copying and pasting the resulting text)
                if ($this->unicodeAlt)
                {
                    $alt = $this->convert($uc_output);
                }
                else
                {
                    $alt = htmlspecialchars($ascii);
                }

                if ($this->sprites)
                {
                    return $m[2].'<span class="emojione emojione-'.$this->spriteSize.'-'.$category.' _'.$filename.'" '.$titleTag.'>'.$alt.'</span>';
                }
                else
                {
                    return $m[2].'<img class="emojione" alt="'.$alt.'" '.$titleTag.' src="' . $this->imagePathPNG . $filename . $this->fileExtension .'"/>';
                }
            }
        }
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  shortname result
     */
    public function toShortCallback($m)
    {
        if ((!is_array($m)) || (!isset($m[0])) || (empty($m[0])))
        {
            return $m[0];
        }
        else
        {
            $ruleset = $this->getRuleset();
            $unicode_replace = $ruleset->getUnicodeReplace();

            $unicode = $m[0];

            if ( !array_key_exists($unicode, $unicode_replace) )
            {
                return $m[0];
            }

            return $unicode_replace[$unicode];
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
        if (stristr($unicode,'-'))
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