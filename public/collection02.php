<?php
//    require_once "/var/www/app/modulo5/classes/api/Criteria.php";
 // require_once "/var/www/app/modulo5/classes/api/Transaction.php";
//    require_once "/var/www/app/modulo5/classes/api/Connection.php";
//    require_once "/var/www/app/modulo5/classes/api/Record.php";
//    require_once "/var/www/app/modulo5/classes/api/Repository.php";
//    require_once "/var/www/app/Model/Produto.php";
//    require_once "/var/www/app/modulo5/classes/api/Logger.php";
//    require_once "/var/www/app/modulo5/classes/api/LoggerTXT.php";
//    require_once "/var/www/app/modulo5/classes/api/LoggerXML.php";
//    require_once "/var/www/app/modulo5/classes/api/LoggerTable.php";
//    require_once "/var/www/app/modulo5/classes/api/LoggerJSON.php";


use modulo5\classes\api\Criteria;
use modulo5\classes\api\Repository;
use modulo5\classes\api\Transaction;
use modulo5\classes\api\LoggerXML;
use Model\Produto;


spl_autoload_register(function($class) {
    $class = "\\var\\www\\app\\Model\\".$class;
    if (file_exists(str_replace('\\', DIRECTORY_SEPARATOR ,$class).'.php')) {
        require_once(str_replace('\\', DIRECTORY_SEPARATOR ,$class).'.php');
    }
});



spl_autoload_register(function($class) {
          $class = "\\var\\www\\app\\".$class;
          if (file_exists(str_replace('\\', DIRECTORY_SEPARATOR ,$class).'.php')) {
              require_once(str_replace('\\', DIRECTORY_SEPARATOR ,$class).'.php');
          }
    });





    
    

try {
    Transaction::open();

    Transaction::setLogger(new LoggerXML('log.xml'));

    $criteria = new Criteria();
    $criteria->add('preco_custo', '<', 31000 );
    $criteria->add('estoque', '>', 10);
    $criteria->setProperty('order', 'descricao');
    $p = new Produto;

//    $repository = new Repository('Produto');
    $repository = new Repository($p);
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







