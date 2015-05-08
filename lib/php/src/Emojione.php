<?php

namespace Emojione;

class Emojione
{
    protected static $client = null;

    /**
     * Magic caller
     */
    public static function __callStatic($name, $args)
    {
        $client = static::getClient();

        if ( method_exists($client, $name) )
        {
            return $client->$name($args);
        }
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
            static::$client = new Client;
        }

        return static::$client;
    }

    /**
     * Set the Client
     *
     * @param  ClientInterface $client The Client
     * @return self
     */
    public static function setClient(ClientInterface $client)
    {
        static::$client = $client;
    }
}
