<?php
    require_once "/var/www/app/modulo5/classes/api/Criteria.php";
    require_once "/var/www/app/modulo5/classes/api/Transaction.php";
    require_once "/var/www/app/modulo5/classes/api/Connection.php";
    require_once "/var/www/app/modulo5/classes/api/Record.php";
    require_once "/var/www/app/modulo5/classes/api/Repository.php";
    require_once "/var/www/app/Model/Produto.php";
    require_once "/var/www/app/modulo5/classes/api/Logger.php";
    require_once "/var/www/app/modulo5/classes/api/LoggerTXT.php";
    require_once "/var/www/app/modulo5/classes/api/LoggerXML.php";
    require_once "/var/www/app/modulo5/classes/api/LoggerTable.php";
    require_once "/var/www/app/modulo5/classes/api/LoggerJSON.php";


    spl_autoload_register(function($class) {
        $class = "\\var\\www\\app\\".$class;
        require_once(str_replace('\\', '/' ,$class).'.php');
    });


    use modulo5\classes\api\teste;

    $produto = new  teste();
    die();
    
    
    

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


function str_replace_assoc(array $replace, $subject) {

    return str_replace(array_keys($replace), array_values($replace), $subject);

}


$replace = array(

    'dog' => 'cat',

    'apple' => 'orange',

'chevy' => 'ford'

);



$string = 'I like to eat an apple with my dog in my chevy';



//echo str_replace_assoc($replace,$string);
//die();

try {
    Transaction::open();

    Transaction::setLogger(new LoggerXML('log.xml'));

    $criteria = new Criteria();
    $criteria->add('preco_custo', '<', 31000 );
    $criteria->add('estoque', '>', 10);
    $criteria->setProperty('order', 'descricao');

    $repository = new Repository('Produto');
    $object = $repository->load($criteria);

    foreach($object as $ob) {
        print "Id produto => ".$ob->id;
        print " - Descricao produto => ".$ob->descricao;
        print "<br>";
    }

    echo "<br>";
    echo $repository->count();

  //  echo $repository->delete($criteria);
   Transaction::close();

   } catch (\Exception $e) {
     print $e->getMessage();
     print "<br>";
    \Transaction::rollback();
}







