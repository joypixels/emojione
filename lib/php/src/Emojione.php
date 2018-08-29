<?php

namespace Emojione;

class Emojione
{
    public static $ascii = false; // convert ascii smileys?
	public static $riskyMatchAscii = false; // set true to match ascii without leading/trailing space char
    public static $unicodeAlt = true; // use the unicode char as the alt attribute (makes copy and pasting the resulting text better)
	public static $emojiVersion = '4.0';
	public static $emojiSize = '32';
	public static $greedyMatch = false;
	public static $blacklistChars = '';
    public static $sprites = false;
	public static $spriteSize = '32';
    public static $imagePathPNG = 'https://cdn.jsdelivr.net/emojione/assets/';
    public static $fileExtension = '.png';
    public static $imageTitleTag = true;
    public static $ignoredRegexp = '<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>';
	public static $unicodeRegexp = '(?:[\x{1F3F3}|\x{1F3F4}]\x{FE0F}?\x{200D}?[\x{1F308}|\x{2620}]\x{FE0F}?)|(?:\x{1F441}\x{FE0F}?\x{200D}?\x{1F5E8}\x{FE0F}?)|(?:[\x{1f468}|\x{1f469}]\x{200d}\x{2764}\x{fe0f}?\x{200d}[\x{1f48b}\x{200d}]*[\x{1f468}|\x{1f469}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1F9B8}|\x{1F9B9}]+[\x{1F3FB}-\x{1F3FF}]?\x{200D}[\x{2640}-\x{2642}]?\x{FE0F}?)|(?:[\x{1F468}|\x{1F469}]+[\x{1F3FB}-\x{1F3FF}]?\x{200D}[\x{1F9B0}-\x{1F9B3}]+\x{FE0F}?)|[\x{0023}-\x{0039}]\x{FE0F}?\x{20e3}|(?:\x{1F3F4}[\x{E0060}-\x{E00FF}]{1,6})|[\x{1F1E0}-\x{1F1FF}]{2}|(?:[\x{1F468}|\x{1F469}]\x{FE0F}?[\x{1F3FB}-\x{1F3FF}]?\x{200D}?[\x{2695}|\x{2696}|\x{2708}|\x{1F4BB}|\x{1F4BC}|\x{1F527}|\x{1F52C}|\x{1F680}|\x{1F692}|\x{1F33E}|\x{1F3EB}|\x{1F3EC}|\x{1f373}|\x{1f393}|\x{1f3a4}|\x{1f3ed}|\x{1f3a8}]\x{FE0F}?)|[\x{1F468}-\x{1F469}\x{1F9D0}-\x{1F9DF}][\x{1F3FA}-\x{1F3FF}]?\x{200D}?[\x{2640}\x{2642}\x{2695}\x{2696}\x{2708}]?\x{FE0F}?|(?:[\x{1F9B5}|\x{1F9B6}]+[\x{1F3FB}-\x{1F3FF}]+)|(?:[\x{1f46e}\x{1F468}\x{1F469}\x{1f575}\x{1f471}-\x{1f487}\x{1F645}-\x{1F64E}\x{1F926}\x{1F937}]|[\x{1F460}-\x{1F482}\x{1F3C3}-\x{1F3CC}\x{26F9}\x{1F486}\x{1F487}\x{1F6A3}-\x{1F6B6}\x{1F938}-\x{1F93E}]|\x{1F46F})\x{FE0F}?[\x{1F3FA}-\x{1F3FF}]?\x{200D}?[\x{2640}\x{2642}]?\x{FE0F}?|(?:[\x{26F9}\x{261D}\x{270A}-\x{270D}\x{1F385}-\x{1F3CC}\x{1F442}-\x{1F4AA}\x{1F574}-\x{1F596}\x{1F645}-\x{1F64F}\x{1F6A3}-\x{1F6CC}\x{1F918}-\x{1F93E}]\x{FE0F}?[\x{1F3FA}-\x{1F3FF}])|(?:[\x{2194}-\x{2199}\x{21a9}-\x{21aa}]\x{FE0F}?|[\x{0023}-\x{002a}]|[\x{3030}\x{303d}]\x{FE0F}?|(?:[\x{1F170}-\x{1F171}]|[\x{1F17E}-\x{1F17F}]|\x{1F18E}|[\x{1F191}-\x{1F19A}]|[\x{1F1E6}-\x{1F1FF}])\x{FE0F}?|\x{24c2}\x{FE0F}?|[\x{3297}\x{3299}]\x{FE0F}?|(?:[\x{1F201}-\x{1F202}]|\x{1F21A}|\x{1F22F}|[\x{1F232}-\x{1F23A}]|[\x{1F250}-\x{1F251}])\x{FE0F}?|[\x{203c}\x{2049}]\x{FE0F}?|[\x{25aa}-\x{25ab}\x{25b6}\x{25c0}\x{25fb}-\x{25fe}]\x{FE0F}?|[\x{00a9}\x{00ae}]\x{FE0F}?|[\x{2122}\x{2139}]\x{FE0F}?|\x{1F004}\x{FE0F}?|[\x{2b05}-\x{2b07}\x{2b1b}-\x{2b1c}\x{2b50}\x{2b55}]\x{FE0F}?|[\x{231a}-\x{231b}\x{2328}\x{23cf}\x{23e9}-\x{23f3}\x{23f8}-\x{23fa}]\x{FE0F}?|\x{1F0CF}|[\x{2934}\x{2935}]\x{FE0F}?)|[\x{2700}-\x{27bf}]\x{FE0F}?|[\x{1F000}-\x{1F6FF}\x{1F900}-\x{1F9FF}]\x{FE0F}?|[\x{2600}-\x{26ff}]\x{FE0F}?|(?:[\x{1F466}-\x{1F469}]+\x{FE0F}?[\x{1F3FB}-\x{1F3FF}]?)|[\x{0030}-\x{0039}]\x{FE0F}';
    public static $shortcodeRegexp = ':([-+\\w]+):';

    protected static $client = null;

    /**
     * Magic caller
     *
     * @throws \BadMethodCallException If the method doesn't exists in client
     */
    public static function __callStatic($method, $args)
    {
        $client = static::getClient();

        // DEPRECATED
        static::updateConfig($client);

        if ( ! method_exists($client, $method) )
        {
            throw new \BadMethodCallException('The method "' . $method . '" does not exist.');
        }

        return call_user_func_array(array($client, $method), $args);

    }

    /**
     * Get the Client
     *
     * @return ClientInterface The Client
     */
    public static function getClient()
    {
        if ( static::$client === null )
        {
            static::setClient(new Client);
        }

        return static::$client;
    }

    /**
     * Set the Client
     *
     * @param  ClientInterface $client The Client
     * @return void
     */
    public static function setClient(ClientInterface $client)
    {
        // DEPRECATED
        static::loadConfig($client);

        static::$client = $client;
    }

    /**
     * Load config from Client
     *
     * @deprecated
     *
     * @param  ClientInterface $client The Client
     * @return self
     */
    protected static function loadConfig(ClientInterface $client)
    {
        static::$ascii               = $client->ascii;
		static::$riskyMatchAscii     = $client->riskyMatchAscii;
        static::$unicodeAlt          = $client->unicodeAlt;
        static::$emojiVersion        = $client->emojiVersion;
        static::$emojiSize		     = $client->emojiSize;
		static::$greedyMatch		 = $client->greedyMatch;
		static::$blacklistChars      = $client->blacklistChars;
        static::$sprites             = $client->sprites;
		static::$spriteSize          = $client->spriteSize;
        static::$imagePathPNG        = $client->imagePathPNG;
        static::$fileExtension       = $client->fileExtension;
        static::$imageTitleTag       = $client->imageTitleTag;
        static::$ignoredRegexp       = $client->ignoredRegexp;
        static::$unicodeRegexp       = $client->unicodeRegexp;
        static::$shortcodeRegexp     = $client->shortcodeRegexp;
    }

    /**
     * Update config in Client
     *
     * @deprecated
     *
     * @param  ClientInterface $client The Client
     * @return self
     */
    protected static function updateConfig(ClientInterface $client)
    {
        $client->ascii               = static::$ascii;
		$client->riskyMatchAscii     = static::$riskyMatchAscii;
        $client->unicodeAlt          = static::$unicodeAlt;
        $client->emojiVersion	     = static::$emojiVersion;
		$client->emojiSize			 = static::$emojiSize;
        $client->greedyMatch		 = static::$greedyMatch;
        $client->blacklistChars      = static::$blacklistChars;
        $client->sprites             = static::$sprites;
		$client->spriteSize          = static::$spriteSize;
        $client->imagePathPNG        = static::$imagePathPNG;
        $client->fileExtension       = static::$fileExtension;
        $client->imageTitleTag       = static::$imageTitleTag;
        $client->ignoredRegexp       = static::$ignoredRegexp;
        $client->unicodeRegexp       = static::$unicodeRegexp;
        $client->shortcodeRegexp     = static::$shortcodeRegexp;
    }
}