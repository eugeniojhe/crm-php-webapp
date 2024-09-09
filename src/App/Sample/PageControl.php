<?php

namespace Control;

class PageControl
{
    public function show()
    {
        $method = isset($_GET['method']) ? $_GET['method'] : null;
        if (method_exists($this, $method)) {
            call_user_func([$this, $method], $_REQUEST);
        } else {
            echo "Metodo => {$method} nao existe";
        }

    }
}