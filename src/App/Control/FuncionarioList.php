<?php

namespace Control;

use General\Control\Action;
use General\Control\Page;
use General\Database\Criteria;
use General\Database\Transaction;
use General\Widgets\Datagrid\Datagrid;
use General\Widgets\Datagrid\DatagridColumn;
use General\Widgets\Dialog\Message;
use General\Widgets\Wrapper\DatagridWrapper;
use General\Database\Repository;
use General\Widgets\Dialog\Question;
use Model\Funcionario;
use PHPUnit\Exception;

class FuncionarioList extends Page
{
    private $datagrid;
    public function __construct()
    {

        try {
            parent::__construct();

            $this->datagrid = new DatagridWrapper(new Datagrid());

            $codigo = new DatagridColumn('id', 'Código', 'right', '10%');
            $nome = new DatagridColumn('nome', 'Nome', 'left', '30%');
            $endereco = new DatagridColumn('endereco', 'Endereco', 'left', '30%');
            $email = new DatagridColumn('email', 'Email', 'left', '30%');

            $this->datagrid->addColumn($codigo);
            $this->datagrid->addColumn($nome);
            $this->datagrid->addColumn($endereco);
            $this->datagrid->addColumn($email);

            $this->datagrid->addAction('Editar', new Action([ new FuncionarioForm, 'onEdit']), 'id');
            $this->datagrid->addAction('Deletar', new Action([new FuncionarioForm, 'onDelete']), 'id');
            parent::add($this->datagrid);
        } catch (Exception $e) {
            new Message('error', $e->getMessage());
            return false;
        }


    }


    public function onReload()
    {
        try {
            Transaction::open();

            $repository = new Repository(new Funcionario());

            $criteria = new Criteria();
            $criteria->setProperty('order', 'id');

            $functionarios = $repository->load($criteria);

            $this->datagrid->clear();
            if (!empty($functionarios)) {
                echo "<pre>";
                foreach ($functionarios as $functionario) {
                    $this->datagrid->addItem($functionario);
                }
            } else {
                new Message('info', 'Nenhum registro encontrado');
                die();
            }

            echo "</pre>";
            Transaction::close();
        }catch (\Exception $exception){
            Transaction::rollback();
            new Message('error', $exception->getMessage());
        }
    }

    public function onDelete($param)
    {
        $action = new Action([$this, 'delete']);
        $action->setParameter('id', $param['id']);
        new Question('Deseja excluir?', $action);
    }

    public function delete($param)
    {
        try {

            Transaction::open();
            $funcionario = Funcionario::find($param['id']);

            if ($funcionario != null) {
                $funcionario->delete();
            }

            Transaction::close();
            $this->onReload();

            new Message('info', 'Registro excluido com sucesso');

        } catch(\Exception $exception){
            new Message('error', $exception->getMessage());
        }
    }


    public function show()
    {
        $this->onReload();
        parent::show();
    }
    public function onEdit()
    {

    }


}