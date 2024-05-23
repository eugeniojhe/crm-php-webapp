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


    public function loadClass1($class): bool {
        $folders = $this->directories;

        $pos = strrpos($class, '\\');
        if ($pos !== false) {
            $class = substr($class, $pos + 1);
        }

        foreach ($folders as $folder) {
            // Check the top-level directory first
            var_dump($folder);
            if (file_exists("{$folder}/{$class}.php")) {
                require_once "{$folder}/{$class}.php";
                return true;
            }

            // Check within subdirectories using RecursiveIteratorIterator
            if (is_dir($folder)) {
                $iterator = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($folder, \RecursiveDirectoryIterator::SKIP_DOTS),
                    \RecursiveIteratorIterator::SELF_FIRST
                );

                foreach ($iterator as $entry) {
                    if ($entry->isDir()) {
                        continue;
                    }

                    if ($entry->isFile() && $entry->getFilename() === "{$class}.php") {
                        require_once $entry->getPathname();
                        return true;
                    }
                }
            }
        }
        return false;
    }


}