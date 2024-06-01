<?php

namespace Control;
use General\Widgets\SimpleForm;

class SimpleFormControl extends PageControl
{
    public function __construct()
    {
        $simpleForm = new SimpleForm('Pessoas');
        $simpleForm->setTitle('Teste de Criação de formulário');
        $simpleForm->addField('Nome', 'nome', 'text', 'José Eugenio', 'form-control');
        $simpleForm->addField('Endereço', 'endereco', 'text', 'Rua Wilson Batista 83', 'form-control');
        $simpleForm->addField('Profissão', 'profissao', 'text', 'Developer web PHP', 'form-control');
        $simpleForm->setAction('index.php?controller=SimpleFormControl&method=onGravar');
        $simpleForm->show();

    }

    public function onGravar($params)
    {
        echo "<pre>";
        var_dump($params);
        echo "</pre>";
    }
}