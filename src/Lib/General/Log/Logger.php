<?php

namespace General\Log;

abstract class Logger
{
    protected $filename;
    protected $path;

    public function __construct($filename)
    {
        $this->path = Config::getLogPath();
        if (!file_exists($this->path)) {
            mkdir($this->path, 0777, true);
        }
        $this->filename = $this->path.DIRECTORY_SEPARATOR.$filename;
        if(!file_exists($this->filename)) {
            file_put_contents($filename, '');
        }
    }

    abstract function write($message);
}


