<?php

namespace Control;
use General\Control\Page;
use General\Widgets\Container\Panel;
use General\Widgets\Container\HBox;


class ExemploBoxControl extends Page
{
    public function __construct()
    {

        parent::__construct();

        $panel1 = new Panel('Panel 1');
        $panel1->style = 'margin:10px';
        $panel1->add('Content of Panel 1');

        $panel2 = new Panel('Panel 2');
        $panel2->style = 'margin:10px';
        $panel2->add('Content of Panel 2');

        $box = new HBox();
        $box->add($panel1);
        $box->add($panel2);

        parent::add($box);
    }
}