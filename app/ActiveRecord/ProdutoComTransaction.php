<?php
class ProdutoComTransaction
{
    protected $data;

    public function __set($property, $value)
    {
        $this->data[$property] = $value;
    }

    public function __get($property)
    {
        return $this->data[$property];
    }

    public static function find($id)
    {
        $sql = "SELECT * FROM Products  WHERE id = ".$id;
            print " $sql ";
        $conn = Transaction::get();
        $result = $conn->query($sql);
        return $result->fetchObject(__CLASS__);
    }

    public static function all($filter = '')
    {
        $sql = "SELECT * FROM Products ";
        if($filter) {
            $sql .= " WHERE ".$filter;
        }

        print " $sql <br>";
        $conn = Transaction::get();
        $result = $conn->query($sql);
        return $result->fetchAll( PDO::FETCH_CLASS, __CLASS__);
    }

    public function save()
    {
        if (empty($this->data['id'])) {
            echo "Saving <br>";
            $id = $this->getLastId();
            $id = ++$id;
            $sql = "INSERT INTO Products (
                        id, descricao, preco_custo, preco_venda, codigo_barras, data_cadastro, origem
                        )".
                " VALUES (
                            '{$id}' , ".
                "'{$this->descricao}' ,".
                "'{$this->preco_custo}' ,".
                "'{$this->preco_venda}' ,".
                "'{$this->codigo_barras}' ,".
                "'{$this->data_cadastro}' ,".
                "'{$this->origem}')";
        } else {
//            $sql =  " UPDATE Products SET DESCRICAO =   '{$this->descricao}' ,".
//                " preco_custo = '{$this->preco_custo}' ,".
//                " preco_venda = '{$this->preco_venda}' ,".
//                " codigo_barras = '{$this->codigo_barras}' ,".
//                " data_cadastro = '{$this->data_cadastro}' ,".
//                " origem = '{$this->origem}'".
//                " WHERE id = '{$this->id}'";

        }
        print "... $sql  "."<br>";
        $conn = Transaction::get();
        return $conn->exec($sql);
    }

    public function delete()
    {
//        $sql = "DELETE FROM Products  WHERE id = ".$this->id;
//        print " $sql ";
//        $conn = Transaction::get();
//
//        $result = $conn->query($sql);
    }

    public function getMargemLucro()
    {
        return (($this->preco_venda - $this->preco_custo) / $this->preco_custo) * 100;
    }

    public function registrarCompra($precoCusto, $qtdCompra)
    {
        $this->preco_custo  = $precoCusto;
        $this->estoque += $qtdCompra;
     }


    public function getLastId()
    {
        $sql = "SELECT max(id) as max FROM Products";
        print " $sql <br>";
        $conn = Transaction::get();
        $result = $conn->query($sql);

//            $data = $result->fetch(PDO::FETCH_ASSOC);
        if ($result !== false) {
            // Fetch the result as an associative array
            $data = $result->fetch(PDO::FETCH_ASSOC);

            // Access the 'max' column from the fetched data
            if ($data && isset($data['max'])) {
                return $data['max'];
            } else {
                // Handle case where no rows were returned
                return null;
            }
        } else {
            // Handle query execution error
            return null;
        }

    }

}