<?php

namespace Control;

use General\Control\Page;
use General\Widgets\Container\Panel;

class ViewSource extends Page
{
    private $form; // formulário

    public function onView($param)
    {

        ini_set('highlight.comment', "#808080");
        ini_set('highlight.default', "#FFFFFF");
        ini_set('highlight.html',    "#C0C0C0");
        ini_set('highlight.keyword', "#62d3ea");
        ini_set('highlight.string',  "#FFC472");

        $class = str_replace('\\', '/', $param['source']);
        $file = "/var/www/App/{$class}.php";
        if (file_exists( $file ))
        {
            $panel = new Panel('Código-fonte: '. $class);
            $panel->id = 'source-panel';
            $panel->add( highlight_file($file, TRUE) );

            parent::add($panel);
        }
    }
}