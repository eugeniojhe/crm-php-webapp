<?php

namespace General\Log;

abstract class Logger
{
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        if(!file_exists($this->filename)) {
            file_put_contents($filename, '');
        }
    }

    abstract function write($message);
}