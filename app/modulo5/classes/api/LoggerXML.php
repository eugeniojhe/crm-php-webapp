<?php

namespace modulo5\classes\api;
class LoggerXML extends Logger
{
    public function write($message)
    {
        $xmlstr = "<?xml version='1.0' encoding='UTF-8'?><log></log>";
        $data = date('Y-m-d H:i:s');
        $log = new \SimpleXMLElement($xmlstr);
        $log->addChild('data', $data);
        $log->addChild('message', $message);
        $message = str_replace(array('&lt', '&gt'), array('<', '>'), $message);
        file_put_contents($this->filename, $log->asXML(), FILE_APPEND);

    }
}