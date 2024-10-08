<?php

namespace Sample;

use General\Control\Action;
use General\Control\Page;
use General\Database\Transaction;
use General\Widgets\Dialog\Message;
use General\Widgets\Forms\CheckGroup;
use General\Widgets\Forms\Combo;
use General\Widgets\Forms\Entry;
use General\Widgets\Forms\Form;
use General\Widgets\Forms\RadioGroup;
use General\Widgets\Wrapper\FormWrapper;
use Model\Funcionario;


class FuncionarioForm extends Page
{
        private $form;
        public function __construct()
        {
            parent::__construct();

            $this->form =  new FormWrapper( new  Form('form_funcionario'));
            $this->form->setTitle('Cadastro de funcionário');

            $id = new Entry('id');
            $nome = new Entry('nome');
            $endereco = new Entry('endereco');
            $email = new Entry('email');
            $departamento = new Combo('departamento');
            $idiomas = new CheckGroup('idiomas');

            $contratacao = new RadioGroup('contratacao');

            $id->setEditable(false);
            $this->form->addField('Código', $id);
            $this->form->addField('Nome', $nome);
            $this->form->addField('Endereco', $endereco);
            $this->form->addField('Email', $email);
            $this->form->addField('Departamento', $departamento);
            $this->form->addField('Idiomas', $idiomas);
            $this->form->addField('Contratacao', $contratacao);

            $departamento->addItems([
                    '1' => 'RH',
                    '2' => 'Atendimento',
                    '3' => 'Contas a receber',
                    '4' => 'Contas a pagar',
                    '5' => 'Produção',
                    '6' => 'Engenhari',
            ]);

            $idiomas->setLayout('vertical');
            $idiomas->addItems([
               '1' => 'Ingles',
               '2' => 'Frances',
               '3' => 'Espanhol',
               '4' => 'Portugues',
               '5' => 'Russo',
               '6' => 'Italian',
               '7' => 'Chines',
            ]);

            $contratacao->setLayout('vertical');
            $contratacao->addItems([
                '1' => 'PJ',
                '2' => 'CLT',
                '3' => 'Estagiário',
                '4' => 'Sócio',
            ]);


            $this->form->addAction('Salvar', new Action([$this, 'onSave']));
            $this->form->addAction('Limar', new Action([$this, 'onClear']));

            parent::add($this->form);
        }

        public function onSave()
        {
            try {
                    Transaction::open();

                    $data = $this->form->getData();
                    $funcionario = new Funcionario();
                    $funcionario->fromArray( (array) $data);
                    $funcionario->idiomas = implode(',', (array) $data->idiomas);
                    $funcionario->store();
                    $data->id = $funcionario->id;

                    $this->form->setData($data);

                    new Message('info', 'Dados salvos com sucesso');

                    Transaction::close();
            } catch ( \Exception $e)
            {
                new Message('error', $e->getMessage());
            }

        }


        public function onEdit($params)
        {
            try {
                Transaction::open();

                $id = isset($params['id']) ? $params['id'] : null;

                $funcionario = Funcionario::find($id);
                if ($funcionario) {

                    if (isset($funcionario->idimoas)) {
                        $funcionario->idiomas = explode(',', $funcionario->idiomas);
                    }
                    $this->form->setData($funcionario);
                }

                Transaction::close();

            } catch (\Exception $e) {
                new Message('error', $e->getMessage());
            }
        }

        public function onClear()
        {
            echo "Inside onClear()\n";
        }
}