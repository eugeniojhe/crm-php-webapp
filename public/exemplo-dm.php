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


        require_once '../app/DM/Products.php';
        require_once '../app/DM/Sales.php';
        require_once '../app/DM/SalesMapper.php';

        \DM\SalesMapper::setConnection($conn);

        $product = new \DM\Products();

        $product->id = 1;
        $product->preco_venda = 1000.00;

        $venda = new \DM\Sales();
        $venda->addItem(12, $product);

        \DM\SalesMapper::save($venda);



