<?php

use modulo5\classes\api\Logger;

class LoggerTXT extends Logger
{
    public function write($message)
    {
        $text = date('Y-m-d h:i:s'). ' : '.$message . "\n";
        $handler = fopen($this->filename, 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}