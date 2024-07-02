<?php

namespace Control;
use General\Widgets\Element;
use General\Control\Page;
use Twig\Node\Expression\ParentExpression;


class ExemploElementControl extends  Page
{
        public function __construct()
        {

//            $d = new Element('div');
//            $p = new Element('p');
//            $d->style = 'text-align:center;';
//            $d->style = 'font-size:25px;';
//            $p->add('Este é um texto dentro do html paragrafo');
//            $d->add($p);
//            $d->show();

              Parent::__construct();

              $div = new Element('div');
              $div->style = 'text-align: center';
              $div->style = 'font-weight: bold';
              $div->style = 'font-size: larger';
              $div->style = 'margin: 20px';
              $div->style = 'item-align: center';
              $div->style = 'justify-content: center';

              $form = new Element ('form');
              $form->action = "";
              $form->method = "POST";

              $label = new Element('label');
              $label->for ="name";
              $label->add('Nome:');
              $form->add($label);

              $input = new Element('input');
              $input->type = "text";
              $input->id ="name";
              $input->name = "name";
              $input->value = "Jose Humberto Eugenio";

              $form->add($input);
              $div->add($form);
              Parent::add($div);



        }
}