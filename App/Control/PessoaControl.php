<?php

namespace Control;

use General\Database\Transaction;
use General\Database\Repository;
use General\Database\Criteria;
use Model\Pessoa;
class PessoaControl
{
    public function list()
    {
        $pessoas = array();
        try {
            Transaction::Open();

            $criteria = new Criteria();
            $criteria->add('id', '=', 1);
            $criteria->setProperty('order', 'id');
            $repository = new Repository(new Pessoa());
            $pessoas =  $repository->load($criteria);

            Transaction::Close();
            return $pessoas;

        } catch (\Exception $e) {
            print $e->getMessage();
        }
        return $pessoas;
    }

    public function show($url)
    {
        if (isset($url['method']) && $url['method'] == "listar") {
            return $this->list();
        }
    }
}