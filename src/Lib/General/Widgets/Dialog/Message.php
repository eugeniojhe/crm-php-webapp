<?php

namespace General\Widgets\Dialog;

use General\Widgets\Element;

class Message extends Element
{
    public function __construct($type, $message)
    {

        $div = new Element('div');
        if ($type == 'info') {
            $div->class = 'alert alert-info';
        } else {
            $div->class = 'alert alert-danger';
        }

        $div->add($message);
        $div->show();

    }

}