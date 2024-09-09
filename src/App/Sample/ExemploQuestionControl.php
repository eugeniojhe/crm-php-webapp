<?php

namespace Control;

use General\Control\Action;
use General\Control\Page;
use General\Widgets\Dialog\Question;

class ExemploQuestionControl extends Page
{
    public function __construct()
    {
        parent::__construct();


        $action1 = New Action([$this, 'onConfirma']);
        $action2 = New Action([$this, 'onNega']);
        new Question('Voce Deseja Confirmar?', $action1, $action2);
    }

    public function onConfirma()
    {

        print "Foi confirmado";
    }

    public function onNega()
    {

        print "Foi negado";

    }
}