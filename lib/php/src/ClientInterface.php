<?php

namespace Emojione;


interface ClientInterface
{
    /**
     * First pass changes unicode characters into emoji markup.
     * Second pass changes any shortnames into emoji markup.
     *
     * @param   string  $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function toImage($string);

    /**
     * Uses toShort to transform all unicode into a standard shortname
     * then transforms the shortname into unicode.
     * This is done for standardization when converting several unicode types.
     *
     * @param   string  $string The input string.
     * @return  string  String with standardized unicode.
     */
    public function unifyUnicode($string);

    /**
     * This will output unicode from shortname input.
     * If Client/$ascii is true it will also output unicode from ascii.
     * This is useful for sending emojis back to mobile devices.
     *
     * @param   string  $string The input string.
     * @return  string  String with unicode replacements.
     */
    public function shortnameToUnicode($string);

    /**
     * This will replace shortnames with their ascii equivalent.
     * ex. :wink: --> ;^)
     * This is useful for systems that don't support unicode or images.
     *
     * @param   string  $string The input string.
     * @return  string  String with ascii replacements.
     */
    public function shortnameToAscii($string);

    /**
     * This will output image markup from shortname input.
     *
     * @param   string  $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function shortnameToImage($string);

    /**
     * This will return the shortname from unicode input.
     *
     * @param   string  $string The input string.
     * @return  string  shortname
     */
    public function toShort($string);

    /**
     * This will output image markup from unicode input.
     *
     * @param   string  $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function unicodeToImage($string);
}