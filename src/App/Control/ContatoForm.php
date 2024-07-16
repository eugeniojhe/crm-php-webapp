<?php

namespace Control;
use General\Control\Page;
use General\Control\Action;
use General\Widgets\Dialog\Message;
use General\Widgets\Forms\Button;
use General\Widgets\Forms\Form;
use General\Widgets\Forms\Entry;
use General\Widgets\Forms\Combo;
use General\Widgets\Forms\Text;
use General\Widgets\Wrapper\FormWrapper;

class ContatoForm extends Page
{
    private $form;

    public function __construct()
    {
        parent::__construct();

        $this->form = new FormWrapper( new Form('Form_contato'));
        $this->form->setTitle('Formulário de Contato');

        $entryNome = new Entry('nome');

        $entryEmail = new Entry('email');
        $comboAssunto = new Combo('assunto');
        $textArea = new Text('messagem');

        $this->form->addField('Nome', $entryNome);
        $this->form->addField('Email', $entryEmail);
        $this->form->addField('Assunto', $comboAssunto);
        $this->form->addField('Assunto', $textArea);

        $comboAssunto->addItems([
            '1' => 'Sugestão',
            '2' => 'Reclamação',
            '3' => 'Informação',
            '4' => 'Ajuda',
        ]);

        $textArea->setSize(300, 80);
        $this->form->addAction('Enviar', new Action([$this, 'onSend']));
        $this->form->addAction('Cancelar', new Action([$this, 'onCancel']));
        parent::add($this->form);
    }

    public function onSend()
    {
        $data = $this->form->getData();
        $this->form->setData($data);

        try {
            if (empty($data->email)) {
                throw new \Exception('Email Inválid', 1);
            }

        } catch (\Exception $e) {
            new Message('danger',$e->getMessage());
        }
        $message = "Nome: {$data->nome}<br>";
        $message .= "Assunto: {$data->assunto}<br>";
        $message .= "Email: {$data->email}<br>" ;
        new Message('info',$message);
    }
}