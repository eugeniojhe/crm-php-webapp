<?php

class LibraryLoader
{
    public static function loadClass($class)
    {
        spl_autoload_register(function ($class) {
            // Convert namespace separators (\) to directory separators (/),
            // and convert the namespace to a directory path.
            print_r($class);
            echo "<br>";
            $file = '/var/www/public/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
//            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            print_r($file);
            echo "<br>";

            // Check if the file exists and is readable.
            if (file_exists($file) && is_readable($file)) {
                require_once $file;
            }
        });
    }
}