<?php

$host = "db";
$username = "root";
$password = "root";
$db = "php_treina";
try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $username,
        $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
    echo '<h2>Conectado com sucesso.<h2>';
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


require_once "../app/tdg/ProdutoGateway.php";


require_once "../app/tdg/Produto.php";

$produto = new Produto;
$produto->setConnection($conn);

$produtoGetWay = new ProdutoGateway();
//$conn = $produtoGetWay->setConnection($conn);


$produto->descricao = "Telefone Sansung J4";
$produto->preco_venda = "1500.00";
$produto->preco_custo = "900.00";
$produto->estoque = 10;
$produto->codigo_barras = "ABCD";
$produto->data_cadastro = date("Y-m-d H:i:s");
$produto->origem = "Brasil";

//$produto->save();

$p = Produto::find(1);


$m = $p->getMargemLucro();
echo $m;
echo "<br>";

die('Dying');


$produtos = Produto::all();
foreach ($produtos as $produto) {
    echo $produto->id."<br>";
    $produto->delete();
}

die('0000');

//$produto = new Produto;
//$produto->setConnection($conn);
//$produto->descricao = "Telefone Sansung J4";
//$produto->preco_venda = "1500.00";
//$produto->preco_custo = "900.00";
//$produto->estoque = 10;
//$produto->codigo_barras = "ABCD";
//$produto->data_cadastro = date("Y-m-d H:i:s");
//$produto->origem = "Brasil";

//die('ONLY TESTE');



$produto->save();


var_dump($produto);

die('End of produto');








$produtoGetWay = new ProdutoGateway();
$conn = $produtoGetWay->setConnection($conn);

$stdClass = new stdClass();
$stdClass->descricao = "Nootebook toshiba - 2024";
$stdClass->preco_custo = "25.00";
$stdClass->preco_venda = "50.00";
$stdClass->codigo_barras = "xccjcjcjcjcj";
$stdClass->data_cadastro = "2024-01-01";
$stdClass->origem="Brazil";

$produtoGetWay->save($stdClass);
//$prod = $produtoGetWay->find(1);
//$prod = $produtoGetWay->all();
//var_dump($prod);


die('OK');

    $loader = require_once '/var/www/app/vendor/autoload.php';
    $loader->register();

use APP\app\tdg\ProdutoGateway;
use PHPMailer\PHPMailer\PHPMailer;

$p = new ProdutoGateway();

   die('dddd');

$mailer = new PHPMailer();

     var_dump($mailer);
    echo "<pr>";
    var_dump( __DIR__);
//    var_dump($loader);


//require_once 'Produto.php';
/*require_once 'Pessoa.php';*/
//require_once 'Customer.php';
//spl_autoload_register(function($class) {
//    if (file_exists("{$class}.php")) {
//        require_once "{$class}.php";
//    }
//});
//use APP\Eugenio\LibraryLoader;

//namespace APP\Eugenio;
//require_once 'LibraryLoader.php';
//
////use APP\Eugenio\LibraryLoader;
//
//
//spl_autoload_register([ new LibraryLoader(), 'loadClass']);
//$customer = new Customer;

//$p = new Produto;
//$p->nome = "Televisor 24 p";
//$p->preco = "1000,00";
//$p->quantidade = "10";
//print_r($p->nome);
//echo "<br>";
//print($p->save());
//echo "<br>";
//print($p->load(10));
//echo "<br>";
//print_r($p->delete(100));
//echo "<br>";
//print_r($p->toJson());
//echo "<br>";
//print_r($p->toXMl());
