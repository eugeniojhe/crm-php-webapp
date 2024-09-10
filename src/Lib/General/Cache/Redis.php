<?php

namespace General\Cache;

class Redis
{

    private static $instance = null;

    //Prevent direct object creation
    private function __construct(){}

    static function open()
    {
        if (self::$instance == null) {
            self::$instance = new \Redis();
            self::$instance->connect('redis', 6379);

        }
    }

    static function setValue($key, $value)
    {
        self::open();
        return self::$instance->set($key, $value);
    }

    static function getValue($key)
    {
        self::open();
        return self::$instance->get($key);
    }

}
