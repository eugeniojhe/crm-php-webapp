<?php

namespace General\Log;

class LoggerJSON extends Logger
{
    public function write($message)
    {

        $data = array (
            'data' => date('Y-m-d h:i:s'),
            'message' => $message
        );
        file_put_contents($this->filename, json_encode($data));
    }
}