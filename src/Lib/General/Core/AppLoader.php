<?php

namespace General\Core;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Exception;


class AppLoader
{
    protected $directories;

    public function addDirectory($directory)
    {
        $this->directories[] = $directory;
    }

   public function register()
   {
       spl_autoload_register(array($this, 'loadClass'));
   }

   public function loadCLass($class):bool {
        $folders = $this->directories;

        $pos = strrpos($class, '\\');
        if ($pos) {
            $class = substr($class, $pos + 1  );

        }
        foreach ($folders as $folder) {
//
            if (file_exists("{$folder}/{$class}.php")) {
                require_once "{$folder}/{$class}.php";
                return true;
            } else {
                if (file_exists($folder)) {
                    foreach(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($folder),
                             \RecursiveIteratorIterator::SELF_FIRST) as $entry) {

                        if (is_dir($entry)) {

                            if (file_exists("{$entry}/{$class}.php")) {
                                    require_once "{$entry}/{$class}.php";
                                    return true;
                            }
                        }

                    }
                }
            }
        }
        return false;
   }

}