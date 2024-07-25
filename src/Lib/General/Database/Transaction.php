<?php

namespace General\Database;


use General\Log\Logger;

class Transaction
{
    private static $conn;
    private static $logger;
    private function __construct() {}

    public static function open()
    {
        self::$conn = Connection::open();
        self::$logger = null;
        return self::$conn->beginTransaction();
    }

    public static function close()
    {
            if (self::$conn) {
                self::$conn->commit();
                self::$conn = null;
            }

    }

    public static function get()
    {
        return self::$conn;
    }

    public static function rollback()
    {
        var_dump(self::$conn);
        if(self::$conn)
        {
            self::$conn->rollback();
        }
    }


    public static function setLogger(Logger $logger)
    {
        self::$logger = $logger;

    }
    public static function log($message)
    {
        if(self::$logger) {
            self::$logger->write($message);
        }
    }

}