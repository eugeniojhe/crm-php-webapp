<?php

namespace Control;

use General\Control\Action;
use General\Control\Page;
use General\Database\Criteria;
use General\Database\Repository;
use General\Database\Transaction;
use General\Widgets\Container\VBox;
use General\Widgets\Datagrid\Datagrid;
use General\Widgets\Datagrid\DatagridColumn;
use General\Widgets\Dialog\Message;
use General\Widgets\Dialog\Question;
use General\Widgets\Forms\Entry;
use General\Widgets\Forms\Form;
use General\Widgets\Wrapper\DatagridWrapper;
use General\Widgets\Wrapper\FormWrapper;
use Model\Pessoa;
use PHPMailer\PHPMailer\Exception;

class PessoasList extends Page
{
    private $form;
    private $datagrid;
    private $loaded;

    public function __construct()
    {
        parent::__construct();
        $this->form = new FormWrapper(new Form('form_busca_pessoas'));
        $this->form->setTitle('Pessoas');

        $nome = new Entry('nome');
        $this->form->addField('Nome', $nome, '100%');
        $this->form->addAction('Buscar pessoa', new Action(array($this, 'onReload')));
        $this->form->addAction('Novo', new Action(array(new PessoasForm, 'onEdit')));

        $this->datagrid = new DatagridWrapper(new Datagrid());

        $codigo = new DatagridColumn('id', 'Código', 'center', '10%');
        $nome = new DatagridColumn('nome', 'Nome', 'center', '40%');
        $endereco = new DatagridColumn('endereco', 'Endereco', 'center', '30%');
        $cidade = new DatagridColumn('nome_cidade', 'Cidade', 'center', '20%');

        $this->datagrid->addColumn($codigo);
        $this->datagrid->addColumn($nome);
        $this->datagrid->addColumn($endereco);
        $this->datagrid->addColumn($cidade);

        $this->datagrid->addAction('Editar', new Action(array(new PessoasForm, 'onEdit')), 'fa fa-pencil');
        $this->datagrid->addAction('Excluir', new Action(array($this, 'onDelete')), 'fa fa-trash');

        $box = new VBox;
        $box->style = 'display:block';
        $box->add($this->form);
        $box->add($this->datagrid);

        parent::add($box);

    }


    public function onReload()
    {
        Transaction::open();
        $repository = new Repository('\Model\Pessoa');

        $criteria = new Criteria();
        $criteria->setProperty('order', 'id');

        $dados = $this->form->getData();


        if ($dados->nome) {
            $criteria->add('nome', 'like', "%{$dados->nome}%");
        }


        $pessoas = $repository->load($criteria);
        $this->datagrid->clear();
        if ($pessoas) {
            foreach ($pessoas as $pessoa) {
                $this->datagrid->addItem($pessoa);
            }
        }

        Transaction::close();
        $this->loaded = true;
    }

    public function onDelete($param)
    {
        $id = $param['id'];
        $action1 = new Action(array($this, 'Delete'));
        $action1->setParameter('id', $id);

        new Question('Deseja realmente excluir o registro?', $action1);
    }

    public function delete($param)
    {
        try {
            Transaction::open();
            $pessoa = Pessoa::find($param['id']);
            $pessoa->delete();
            Transaction::close();
            $this->onReload();
            new Message('Info', 'Registro excluido com sucess');

        } catch (Exception $exception) {
            new Message('erro', $exception->getMessage());
        }
    }

    public function show()
    {
        if (!$this->loaded) {
            $this->onReload();
        }
        parent::show();
    }
}