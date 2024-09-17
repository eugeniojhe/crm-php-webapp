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

            $this->dados = $this->form->getData();
            $this->form->setData($this->dados);
            $this->class = new $this->activeRecord;
            $this->class->fromArray( (array) $this->dados);
            $this->class->store();

//            Transaction::close();
        } catch (\Exception $e) {
            new Message('Error', $e->getMessage());
            Transaction::rollback();
        }
    }

}