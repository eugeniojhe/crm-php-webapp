<?php
namespace General\Control;

use General\Widgets\Element;

class Page extends  Element
{
    public function __construct()
    {
        Parent::__construct('div');
    }

    public function show()
    {
        if ($_GET){
            $method = isset($_GET['method']) ?  trim($_GET['method'], "\x00..\x1; ") : 'index'; ;

            if (isset($_GET['method'])) {
                if (method_exists($this, $method)) {
                    call_user_func([$this, $method], $_GET);
                } else {
                    throw new \Exception("Method {$method} does not exist");
                }
            }

        }
        Parent::show();
    }
}