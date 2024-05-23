<?php

namespace Services;

use General\Database\Transaction;
use Model\Pessoa;

class PessoaService
{
    public static function getData($request)
    {
        Transaction::open();

        $arrayPessoa = [];

        $idPessoa = $request['id'];
        $pessoa = Pessoa::find($idPessoa);
        if ($pessoa) {
            $arrayPessoa = $pessoa->toArray();
        } else {
            throw new \Exception("Pessoa {$idPessoa} não cadastrada ::");
        }
        Transaction::close();
        return $arrayPessoa;
    }
}