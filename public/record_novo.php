<?php
require_once "/var/www/app/modulo5/classes/api/Transaction.php";
require_once "/var/www/app/modulo5/classes/api/Connection.php";
require_once "/var/www/app/modulo5/classes/api/Logger.php";
require_once "/var/www/app/modulo5/classes/api/LoggerTXT.php";
//require_once "/var/www/app/modulo5/classes/api/LoggerXML.php";
//require_once "/var/www/app/modulo5/classes/api/LoggerTable.php";
//require_once "/var/www/app/modulo5/classes/api/LoggerJSON.php";
require_once "/var/www/app/modulo5/classes/api/Record.php";
require_once "/var/www/app/Model/Produto.php";


$resulta = "AND N = 1";
$resultb = "AND N = 1";
//print $result."<br>";
//$r1 = "($result)";
//print $r1."<br>";
$result1 = "($resulta)";
$result2 = "({$resultb})";
print $result1."<br>";
print $result2;
die();






$result = "("."'abcd'".")";
die($result);

Transaction::open();
Transaction::setLogger(new LoggerTXT('log.txt'));


//$produto =  Produto::find(1);
//if($produto) {
//    print $produto->descricao;
//}
$produto =  new Produto();
$p = $produto->find(5);
if($p) {
    $p->estoque += 10;
    $p->store();
//    print $p->descricao;
//    $p->delete();
}


//$produto = new Produto(1);
//$produto->descricao = "Geladeira 54 pl";
//$produto->preco_custo = '1000';
//$produto->preco_venda = '2000';
//$produto->codigo_barras = "xxxxxyy";
//$produto->data_cadastro = date('Y-m-d');
//$produto->origem = "Brasil";
//
//$produto->store();

Transaction::close();





