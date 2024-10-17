<?php

namespace General\Traits;

use General\Database\Transaction;
use General\Widgets\Dialog\Message;

trait SaveTrait
{
    public function onSave()
    {
        try {
            Transaction::open();

            $class = $this->activeRecord;
            $dados = $this->form->getData();


            $object = new $class; // instancia objeto
            $object->fromArray( (array) $dados); // carrega os dados
            $object->store(); // armazena o objeto

            $dados->id = $object->id;
            $this->form->setData($dados);

            Transaction::close(); // finaliza a transação
            new Message('info', 'Dados armazenados com sucesso');
        } catch (\Exception $e) {
            new Message('Error', $e->getMessage());
            Transaction::rollback();
        }
    }

}