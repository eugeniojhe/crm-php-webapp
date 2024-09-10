<?php

//namespace APP\pdo;

class Pdo1
{
    private $host = "db";
    private $username = "root";
    private  $password = "root";
    private $db = "php_treina";
    public function connect(){
        try {
            $conn = new Pdo1("mysql:host=$this->host;dbname=$this->db", $this->username,
                $this->password);
            $conn->setAttribute(Pdo1::ATTR_ERRMODE,
                Pdo1::ERRMODE_EXCEPTION);
            echo '<h2>Conectado com sucesso.<h2>';
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}