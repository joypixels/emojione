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
    public static $ignoredRegexp = '<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>';
    public static $unicodeRegexp = '([#0-9](?>\\xEF\\xB8\\x8F)?\\xE2\\x83\\xA3|\\xC2[\\xA9\\xAE]|\\xE2..(?>\\xEF\\xB8\\x8F)?|\\xE3(?>\\x80[\\xB0\\xBD]|\\x8A[\\x97\\x99])(?>\\xEF\\xB8\\x8F)?|\\xF0\\x9F(?>[\\x80-\\x86].(?>\\xEF\\xB8\\x8F)?|\\x87.\\xF0\\x9F\\x87.|..))';
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
        static::$unicodeAlt          = $client->unicodeAlt;
        static::$imageType           = $client->imageType;
        static::$cacheBustParam      = $client->cacheBustParam;
        static::$sprites             = $client->sprites;
        static::$imagePathPNG        = $client->imagePathPNG;
        static::$imagePathSVG        = $client->imagePathSVG;
        static::$imagePathSVGSprites = $client->imagePathSVGSprites;
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
        $client->unicodeAlt          = static::$unicodeAlt;
        $client->imageType           = static::$imageType;
        $client->cacheBustParam      = static::$cacheBustParam;
        $client->sprites             = static::$sprites;
        $client->imagePathPNG        = static::$imagePathPNG;
        $client->imagePathSVG        = static::$imagePathSVG;
        $client->imagePathSVGSprites = static::$imagePathSVGSprites;
        $client->ignoredRegexp       = static::$ignoredRegexp;
        $client->unicodeRegexp       = static::$unicodeRegexp;
        $client->shortcodeRegexp     = static::$shortcodeRegexp;
    }
}
