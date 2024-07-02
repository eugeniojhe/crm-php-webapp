<?php

namespace General\Control;

class Action implements ActionInterface
{
    private $action;
    private $parameter;
    public function __construct($action)
    {
        $this->action = $action;
    }

    public function setParameter($parameter, $value)
    {
        $this->parameter[$parameter] =  $value;

    }

    public function serialize()
    {
        if (is_array($this->action)) {

           $url['controller'] = is_object($this->action[0]) ? get_class($this->action[0]) : $this->action[0];
           $url['method'] = is_object($this->action[1]) ? get_class($this->action[1]) : $this->action[1];
           if ($this->parameter) {
               $url = array_merge($url, $this->parameter);
           }
            return '?' . http_build_query($url);

       }

    }

}