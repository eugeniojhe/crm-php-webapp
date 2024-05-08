<?php

       echo phpinfo();
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
