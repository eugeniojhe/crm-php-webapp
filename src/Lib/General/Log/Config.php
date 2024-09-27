<?php

namespace General\Log;

class Config
{
    private static $config;

    public static function loadConfig():void
    {
         $environment  = $_ENV['APP_ENV'] ?:'development';
         switch ($environment) {
             case 'production':
                 $configFile = 'config_production.php';
                 break;
             case 'development':
                  $configFile = 'config_development.php';
                  break;
             case 'staging':
                 $configFile = 'config_staging.php';
                 break;
             default:
                 $configFile = 'config_development.php';
         }

        $configPath = $_ENV['CONFIG_PATH'] .DIRECTORY_SEPARATOR.$configFile;
        if (file_exists($configPath)) {
            self::$config = include $configPath;
        } else {
            throw new \Exception("Config file not found: " . $configPath);
        }

    }

    public static function getConfig():string
    {
        self::loadConfig();
        return self::$config;
    }

    public static function getLogger()
    {
        $fileLogger =  self::getConfig()['logger']['files'];
        return str_replace('{DATE}', date('dmY'), $fileLogger);
    }

    public static function getLogFileTxt()
    {
        return self::getLogger()['txt'];
    }

    public static function getLogFileXml()
    {
        return self::getLogger()['xml'];
    }

    public static function getLogFileJson()
    {
        return self::getLogger()['json'];
    }
    public static function getLogPath()
    {
        return self::getConfig()['logger']['path'];
    }
}


