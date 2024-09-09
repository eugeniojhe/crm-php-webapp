<?php

namespace Sample;

use General\Control\Page;
use General\Widgets\Container\Panel;

class ExemploPanelControl extends Page
{
    public function __construct()
    {
        parent::__construct();
        $panel = new Panel('Titulo de Paine');
        $panel->style = 'margin: 20px';
        $panel->add(' Conteudo Conteudo Conteudo Conteudo');
        $panel->addFooter('Este é o Rodapé do Panel');

        parent::add($panel);

    }
}