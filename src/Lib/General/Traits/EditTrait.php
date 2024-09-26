<?php

namespace General\Traits;

use General\Database\Transaction;
use General\Widgets\Dialog\Message;

trait EditTrait
{
    function onEdit($param)
    {
        try
        {
            if (isset($param['id']))
            {
                $id = $param['id']; // obtém a chave
                Transaction::open(); // inicia transação com o BD

                $class = $this->activeRecord;
                $object = $class::find($id); // instancia o Active Record
                $this->form->setData($object); // lança os dados no formulário
                Transaction::close(); // finaliza a transação
            }
        }
        catch (\Exception $e)
        {
            new Message('error', $e->getMessage());
            Transaction::rollback();
        }
    }
}