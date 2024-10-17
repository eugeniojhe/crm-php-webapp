<?php

namespace General\Traits;

use General\Control\Action;
use General\Database\Transaction;
use General\Widgets\Dialog\Message;
use General\Widgets\Dialog\Question;

trait DeleteTrait
{
        function onDelete($param)
        {
            $id = $param['id']; // obtém o parâmetro $id
            $action1 = new Action(array($this, 'Delete'));
            $action1->setParameter('id', $id);

            new Question('Deseja realmente excluir o registro?', $action1);
        }

    function Delete($param)
    {
        try
        {
            $id = $param['id']; // obtém a chave
            Transaction::open(); // inicia transação com o BD

            $class = $this->activeRecord;

            $object = $class::find($id); // instancia objeto
            $object->delete(); // deleta objeto do banco de dados
            Transaction::close(); // finaliza a transação
            $this->onReload(); // recarrega a datagrid
            new Message('info', "Registro excluído com sucesso");
        }
        catch (Exception $e)
        {
            new Message('error', $e->getMessage());
        }
    }

}