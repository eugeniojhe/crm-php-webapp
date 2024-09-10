<?php

namespace General\Widgets\Container;


use General\Widgets\Element;

class HBox extends Element
{
    public function __construct()
    {
        parent::__construct("div");
    }

    public function add($child)
    {
        $wrapper = new Element('div');
        $wrapper->style = 'display: inline-block';
        $wrapper->add($child);
        parent::add($wrapper);
        return $wrapper;
    }
}