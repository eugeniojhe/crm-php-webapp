<?php

namespace Control;

use General\Control\Action;
use General\Control\Page;
use General\Widgets\Container\Panel;
use General\Widgets\Element;
use General\Widgets\Forms\Button;
use General\Widgets\Forms\CheckGroup;
use General\Widgets\Forms\Combo;
use General\Widgets\Forms\Entry;
use General\Widgets\Forms\Form;
use General\Widgets\Wrapper\FormWrapper;
use General\Database\Transaction;
use Model\Pessoa;
use Model\Cidade;
use Model\Grupo;
use General\Widgets\Dialog\Message;

class PessoasForm extends Page
{
        private $form;

        public function __construct()
        {

            parent::__construct();
            $this->form = new FormWrapper(new Form('form_pessoas'));
            $this->form->setTitle = ('Pessoa');
            $codigo = new Entry('id');
            $nome = new Entry('nome');
            $endereco = new Entry('endereco');
            $bairro = new Entry('bairro');
            $telefone = new Entry('telefone');
            $email = new Entry('email');
            $cidade = new Combo('id_cidade');
            $grupo = new CheckGroup('ids_group');
            $grupo->setLayout('horizontal');


            Transaction::open();

            $cidades = Cidade::all();
            $items = [];
            foreach ($cidades as $cidadeObj) {
                $items[$cidadeObj->id] = $cidadeObj->nome;
            }
            $cidade->addItems($items);

            $grupos = Grupo::all();
            $items = [];
            foreach ($grupos as $grupoObj) {
                $items[$grupoObj->id] = $grupoObj->nome;
            }
            $grupo->addItems($items);
            Transaction::close();

            $this->form->addField('Código', $codigo, '30%');
            $this->form->addField('Nome', $nome, '30%');
            $this->form->addField('Telefone', $telefone, '30%');
            $this->form->addField('Email', $email, '30%');
            $this->form->addField('Cidade', $cidade, '30%');
            $this->form->addField('Endereco', $endereco, '30%');
            $this->form->addField('Bairro', $bairro, '30%');
            $this->form->addField('Grupo', $grupo, '30%');

            $codigo->setEditable(false);
            $this->form->addAction('Salvar', new Action(array($this, 'onSave'), true));


            parent::add($this->form);
        }

        public function onSave()
        {
            try {
                Transaction::open();

                $dados = $this->form->getData();
                $this->form->setData($dados);
                $pessoa = New Pessoa();
                $pessoa->fromArray( (array) $dados);
                $pessoa->store();

                $pessoa->delGrupos();
                if (is_array($dados->ids_group)) {
                    foreach ($dados->ids_group as $id_grupo)
                    {
                        $pessoa->addGrupo( new Grupo($id_grupo) );
                    }
                }

                Transaction::close();
            } catch (\Exception $e) {
                new Message('Error', $e->getMessage());
                Transaction::rollback();
            }
        }


}