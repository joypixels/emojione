<?php

namespace Emojione;

class Emojione
{
    public static $ascii = false; // convert ascii smileys?
    public static $unicodeAlt = true; // use the unicode char as the alt attribute (makes copy and pasting the resulting text better)
	public static $emojiVersion = '3.0';
	public static $emojiSize = '64';
	public static $greedyMatch = false;
    public static $sprites = false;
    public static $imagePathPNG = 'https://cdn.jsdelivr.net/emojione/assets/';
    public static $imagePathSVGSprites = './../../assets/sprites/emojione.sprites.svg';
    public static $imageTitleTag = true;
    public static $ignoredRegexp = '<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>';
	public static $unicodeRegexp = '/(?:(?:(?:[\x{2600}-\x{26ff}]|[\x{2700}-\x{27bf}]|[\x{1F000}-\x{1F6FF}])[\x{fe0f}\x{200d}]*)+)|[\x{0023}-\x{0039}]\x{fe0f}?\x{20e3}|[\x{1F1E0}-\x{1F1FF}]{2}|(?:[\x{2194}-\x{2199}\x{21a9}-\x{21aa}]|[\x{0023}-\x{002a}]|[\x{3030}\x{303d}]\x{fe0f}?|(?:[\x{1F170}-\x{1F171}]|[\x{1F17E}-\x{1F17F}]|\x{1F18E}|[\x{1F191}-\x{1F19A}]|[\x{1F1E6}-\x{1F1FF}])\x{fe0f}?|\x{24c2}\x{fe0f}?|[\x{3297}\x{3299}]\x{fe0f}?|(?:[\x{1F201}-\x{1F202}]|\x{1F21A}|\x{1F22F}|[\x{1F232}-\x{1F23A}]|[\x{1F250}-\x{1F251}])\x{fe0f}?|[\x{203c}\x{2049}]\x{fe0f}?|[\x{25aa}-\x{25ab}\x{25b6}\x{25c0}\x{25fb}-\x{25fe}]\x{fe0f}?|[\x{00a9}\x{00ae}]\x{fe0f}?|[\x{2122}\x{2139}]\x{fe0f}?|\x{1F004}\x{fe0f}?|[\x{2b05}-\x{2b07}\x{2b1b}-\x{2b1c}\x{2b50}\x{2b55}]\x{fe0f}?|[\x{231a}-\x{231b}\x{2328}\x{23cf}\x{23e9}-\x{23f3}\x{23f8}-\x{23fa}]\x{fe0f}?|\x{1F0CF}|[\x{2934}\x{2935}]\x{fe0f}?)|[\x{0030}-\x{0039}]\x{fe0f}/u';
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
        static::$emojiVersion        = $client->emojiVersion;
        static::$emojiSize		     = $client->emojiSize;
		static::$greedyMatch			 = $client->greedyMatch;
        static::$sprites             = $client->sprites;
        static::$imagePathPNG        = $client->imagePathPNG;
        static::$imagePathSVG        = $client->imagePathSVG;
        static::$imageTitleTag       = $client->imageTitleTag;
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
        $client->emojiVersion	     = static::$emojiVersion;
		$client->emojiSize			 = static::$emojiSize;
		$client->greedyMatch			 = static::false;
        $client->sprites             = static::$sprites;
        $client->imagePathPNG        = static::$imagePathPNG;
        $client->imageTitleTag       = static::$imageTitleTag;
        $client->imagePathSVGSprites = static::$imagePathSVGSprites;
        $client->ignoredRegexp       = static::$ignoredRegexp;
        $client->unicodeRegexp       = static::$unicodeRegexp;
        $client->shortcodeRegexp     = static::$shortcodeRegexp;
    }
}