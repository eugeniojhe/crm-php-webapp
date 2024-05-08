<?php

    require_once "/var/www/app/modulo5/classes/api/Transaction.php";
    require_once "/var/www/app/modulo5/classes/api/Connection.php";
    require_once "/var/www/app/ActiveRecord/ProdutoComTransaction.php";

    try {

        Transaction::open();

        $produto = new ProdutoComTransaction();
        $produto->descricao = "Televisor 54 pl";
        $produto->preco_custo = '1000';
        $produto->preco_venda = '2000';
        $produto->codigo_barras = "xxxxxyy";
        $produto->data_cadastro = date('Y-m-d');
        $produto->origem = "Brasil";

        $produto->save();


        $produto = new ProdutoComTransaction();
        $produto->descricao = "Televisor 54 pl 2 12 ";
        $produto->preco_custo = '1000.00';
        $produto->preco_venda = '2000';
        $produto->codigo_barras = "xxxxxyy";
        $produto->data_cadastro = date('Y-m-d');
        $produto->origem = "Brasil";

        $produto->save();

        Transaction::close();
        echo "Transaction closed<br>";


    } catch (Exception $e)
    {
        Transaction::rollback();
        print $e->getMessage();
    }

