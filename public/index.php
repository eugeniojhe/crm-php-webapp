<?php

       require_once "/var/www/Lib/General/Database/Connection.php";
       require_once "/var/www/Lib/General/Core/ClassLoader.php";
       require_once "/var/www/Lib/General/Core/AppLoader.php";


$loader = new General\Core\ClassLoader();
$loader->addNamespace('General\Database', 'Lib/General/Database');
$loader->register();
var_dump($_REQUEST);
echo "<br>";
var_dump($_GET);
echo "<br>";

$method = ['method'];
var_dump(array_flip($method));
echo "<br>";

$paramValue = array_intersect_key($_REQUEST, array_flip(['method']));
var_dump($paramValue);



$appLoader = new General\Core\AppLoader();
$appLoader->register();
$appLoader->addDirectory('/var/www/App');

$pessoa = new Control\PessoaControl();

$pessoas = $pessoa->list();

echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Id</th>";
echo "<th>Nome</th>";
echo "</tr>";
echo "</thead>";

echo "<body>";

foreach($pessoas as $pessoa) {
    echo "<tr>";
    echo "<td>$pessoa->id</td>";
    echo "<td>{$pessoa->name}</td>";
    echo "</tr>";
}

echo "</body>";
echo "</table>";

die();





$conn = Connection::Open();
       var_dump($conn);
       Echo "That is ok";


        $iniLoadedFile = php_ini_loaded_file();
       echo $iniLoadedFile.PHP_EOL;
       die(); 


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


        require_once '../app/ActiveRecord/Produto.php';
        Produto::setConnection($conn);




        $produtos = Produto::all();
        foreach ($produtos as $produto) {
            echo $produto->id."<br>";
            $produto->delete();
        }


        $produto = new Produto;



        $produto->descricao = "Vinho tinto tres ranchos";
        $produto->preco_venda = "1500.00";
        $produto->preco_custo = "900.00";
        $produto->estoque = 10;
        $produto->codigo_barras = "ABCD";
        $produto->data_cadastro = date("Y-m-d H:i:s");
        $produto->origem = "Brasil";

        $produto->save();


        $produto->id = 1;
        $produto->find(1);

        $produto->preco_custo = "1000000.00";
        $produto->estoque = 500;
        $produto->save();

        $m = $produto->getMargemLucro();
        echo $m."<br>";





        die('ok');

        $p = Produto::find(1);



        echo $m;
        echo "<br>";

        die('Dying');




        die('0000');
