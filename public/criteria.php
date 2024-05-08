<?php
require_once "/var/www/app/modulo5/classes/api/Criteria.php";
require_once "/var/www/app/modulo5/classes/api/Transaction.php";
require_once "/var/www/app/modulo5/classes/api/Connection.php";
require_once "/var/www/app/modulo5/classes/api/Record.php";
require_once "/var/www/app/Model/Produto.php";
require_once "/var/www/app/modulo5/classes/api/Logger.php";
require_once "/var/www/app/modulo5/classes/api/LoggerTXT.php";
require_once "/var/www/app/modulo5/classes/api/LoggerXML.php";
require_once "/var/www/app/modulo5/classes/api/LoggerTable.php";
require_once "/var/www/app/modulo5/classes/api/LoggerJSON.php";

//use modulo5\classes\api\Criteria;

//$arrTeste = array (
//    'array' => [
//        'a' => 'a',
//        'b' => 'b',
//    ],
//
//    'inteiro' => 1,
//    'string' => '1',
//    'boolean' => true,
//    'null' => null,
//);

//if (is_array($arrTeste['array'])) {
//    echo "Array.<br>";
//}
//if (is_integer($arrTeste['inteiro'])) {
//    echo "Inteiro.<br>";
//}
//if (is_string($arrTeste['string'])) {
//    echo "String<br>";
//}
//if (is_bool($arrTeste['boolean'])) {
//    echo "Boolean<br>";
//}
//if (is_null($arrTeste['null'])) {
//    echo "Null<br>";
//}
//
//var_dump($arrTeste);
//die();

$criteria = new Criteria;

$criteria->add('idade', '<', 60);
$criteria->add('idade', '>', 80, 'or');
print $criteria->dump()."<br>";

$criteria = new Criteria;
$criteria->add('idade', 'IN', array(10, 20, 30));
$criteria->add('idade', 'NOT IN', array(100));
print $criteria->dump()."<br>";







