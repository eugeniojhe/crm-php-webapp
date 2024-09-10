<?php

namespace General\Widgets\Dialog;


use General\Widgets\Element;
use General\Control\Action;

class Question
{
    function __construct($message, Action $actionYes, Action $actionNo = null)
    {

        $div = new Element('div');
        $div->class = 'alert alert-warning question';

        $urlYes = $actionYes->serialize();

        $linkYes = new Element('a');
        $linkYes->href = $urlYes;
        $linkYes->class = 'btn btn-default';
        $linkYes->style = 'float: right';
        $linkYes->add('Sim');

//        $message .= '&nbsp;' . $linkYes;
        $message .=  $linkYes;
        if ($actionNo){
            $urlNo = $actionNo->serialize();
            $linkNo = new Element('a');
            $linkNo->href = $urlNo;
            $linkNo->class = 'btn btn-default';
            $linkNo->style = 'float: right';
            $linkNo->add('Não');

            $message .= $linkNo;
        }

        $div->add($message);
        $div->show();
   }
}