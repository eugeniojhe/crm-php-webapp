<?php

namespace DM;

class SalesMapper
{

    private static $conn;
    public static function setConnection(\PDO $conn)
    {
        self::$conn = $conn;
    }
    public static function save(Sales $sales)
    {
        $date = date('Y-m-d');

        $sql = "INSERT INTO Vendas (data_venda) VALUES ('$date')";

        self::$conn->query($sql);

        $id = self::getLastId();

        $sales->setId($id);

        foreach($sales->getItems() as $item){
            $quantidade = $item[0];
            $produto = $item[1];
            $preco = $produto->preco_venda;
            print $preco."<br>";
            print $quantidade."<br>";
            $id_produto = $produto->id;


            $sql = "INSERT INTO Itens_vendas (id_venda, id_produto, quantidade, preco) VALUES
                                                                       ('{$id}', '{$id_produto}', '{$quantidade}', '{$preco}')";
            print $sql."<br>";
            self::$conn->query($sql);
        }

    }
    public static function getLastId()
    {
        $sql = "SELECT MAX(id) as max FROM Vendas";
        $result = self::$conn->query($sql);
        $data = $result->fetchObject();
        return $data->max;
    }

}