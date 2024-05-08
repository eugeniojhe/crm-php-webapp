<?php

    require_once "/var/www/app/modulo5/classes/api/Transaction.php";
    require_once "/var/www/app/modulo5/classes/api/Connection.php";
    require_once "/var/www/app/ActiveRecord/ProdutoComTransactionELOG.php";
    require_once "/var/www/app/modulo5/classes/api/Logger.php";
    require_once "/var/www/app/modulo5/classes/api/LoggerTXT.php";
    require_once "/var/www/app/modulo5/classes/api/LoggerXML.php";
    require_once "/var/www/app/modulo5/classes/api/LoggerTable.php";
    require_once "/var/www/app/modulo5/classes/api/LoggerJSON.php";
    echo phpinfo();


//    $str = "O'Reilly\?";
//    echo $str."<br>";
//    eval("echo '" . addslashes($str) . "';");
//    echo "<br>";
//    $result =  addslashes($str);
//    $value = "'$result'";
//    echo $value."<br>";

    try {

        Transaction::open();
        Transaction::setLogger(new LoggerXML('logger.xml'));
    //    Transaction::setLogger(new LoggerTXT('logger.txt'));
        //        Transaction::setLogger(new LoggerTable('Logs'));

    //    Transaction::setLogger(new LoggerJSON('logger.json'));


        $produto = new ProdutoComTransactionELOG();
        $produto->descricao = "Geladeira 54 pl";
        $produto->preco_custo = '1000';
        $produto->preco_venda = '2000';
        $produto->codigo_barras = "xxxxxyy";
        $produto->data_cadastro = date('Y-m-d');
        $produto->origem = "Brasil";

        $produto->save();


        $produto = new ProdutoComTransactionELOG();
        $produto->descricao = "Ar condicionado samsung 54 pl 2 12 ";
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

