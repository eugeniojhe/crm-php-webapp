<?php

    namespace General\Core;
class ClassLoader
{
    protected $prefixes = array();

    public function  register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }


    public function addNamespace($prefix, $base_dir, $prepend = false)
    {
        //Normaliza namepace prefix
        $prefix = trim($prefix, '\\') . '\\';

        //Normalize the base directory with a trailing separator

        $base_dir = trim($base_dir, DIRECTORY_SEPARATOR) .  '/';

        //Initializa the namespace prefix array

        if (isset($prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = array();
        }

        //retain the namespace prefix array

        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $base_dir);
        } else {
          array_push($this->prefixes[$prefix], $base_dir);
        }
    }

    public function loadClass($class)
    {
        //the current namespace prefix - The current class being referencide
        $prefix = $class;
        $workingDir = trim((getenv('WORKING_DIR')) ? getenv('WORKING_DIR') .'/' : '');

        while (false !== $pos = strrpos($prefix, '\\')) {
            $prefix = substr($class, 0,$pos + 1);
            $relative_class = substr($class, $pos + 1);

            $mapped_file = $this->loadMappedFile($prefix, $relative_class, $workingDir);
            if ($mapped_file) {
                return $mapped_file;
            }

            $prefix = rtrim($prefix, '\\');
        }

        return false;
    }

    protected function loadMappedFile($prefix, $class, $workingDir = '')
    {
        if (isset($this->prefixes[$prefix]) === false) {
            return false;
        }

        foreach ($this->prefixes[$prefix] as $base_dir) {
                $file = $workingDir .
                $base_dir .
                str_replace('\\', '/', $class).
               '.php';
            if ($this->fileRequired($file)) {
                return $file;
            }
            return false;
        }
        return false;
    }

    protected function fileRequired($file):bool {
        if (file_exists($file)) {
            require_once("{$file}");
            return true;
        }
        return false;
    }

}