<?php
namespace modulo5\classes\api;

//use modulo5\classes\api\Logger;

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
            return self::$conn->commit();
            self::$conn = null;
    }

    public static function get()
    {
        return self::$conn;
    }

    public static function rollback()
    {
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