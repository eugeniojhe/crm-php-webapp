<?php

namespace Sample;
use General\Control\Page;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigSampleControl extends Page
{

    private $form;
    private $twig;
    public function __construct()
    {
        parent::__construct();
        $loader = new FilesystemLoader('/var/www/App/Resources');
        $this->twig = new Environment($loader);
        $this->form = [];
       // echo $twig->render('template1.html', $data);
    }

    public function  render()
    {
        $this->form['title'] = 'Cadastro de pessoas';
//        $this->form['nome'] = 'José Humberto Eugenio';
//        $this->form['endereco'] = 'Rua Wilson Batista 83';
//        $this->form['cep'] = '38409-491';
//        $this->form['telefone'] = '(34) 98861 8595';
        $this->form['action'] = 'index.php?controller=Control\TwigSampleControl&method=onGravar';
        $this->twig->display('form.html', $this->form);
    }

    public function onGravar()
    {
        echo "<pre>";
        var_dump($_REQUEST);
        echo "</pre>";
    }

}