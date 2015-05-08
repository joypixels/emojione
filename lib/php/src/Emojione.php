<?php

namespace Emojione;

class Emojione
{
    protected static $client = null;

    /**
     * Magic caller
     *
     * @throws \BadMethodCallException If the method doesn't exists in client
     */
    public static function __callStatic($method, $args)
    {
        $client = static::getClient();

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
        static::$client = $client;
    }
}
