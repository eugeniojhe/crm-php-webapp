<?php

class ProdutoGateway
{
        private static $conn;
        public static function setConnection(\PDO $conn)
        {
            self::$conn = $conn;
        }
        public function find($id, $class = 'stdClass')
        {
            $sql = "SELECT * FROM Products  WHERE id = ".$id;
//            print " $sql ";
            $result = self::$conn->query($sql);
            return $result->fetchObject($class);
        }
//
        public function all($filter = null, $class= 'stdClass')
        {
            $sql = "SELECT * FROM Products ";
            if($filter) {
                $sql .= " WHERE ".$filter;
            }

            print " $sql <br>";
            $result = self::$conn->query($sql);
            return $result->fetchAll( PDO::FETCH_CLASS, 'Produto');
        }

        public function delete($id)
        {
            $sql = "DELETE FROM Products  WHERE id = ".$id;
            print " $sql ";
           $result = self::$conn->query($sql);
        }


//
        public function save($data)
        {
          if (empty($data->id)) {
               echo "Saving <br>";
                $id = $this->getLastId();
                $id = ++$id;
                $sql = "INSERT INTO Products (
                        id, descricao, preco_custo, preco_venda, codigo_barras, data_cadastro, origem
                        )".
                     " VALUES (
                            '{$id}' , ".
                            "'{$data->descricao}' ,".
                            "'{$data->preco_custo}' ,".
                            "'{$data->preco_venda}' ,".
                            "'{$data->codigo_barras}' ,".
                            "'{$data->data_cadastro}' ,".
                            "'{$data->origem}')";
              } else {
              $sql =  " UPDATE Products SET DESCRICAO =   '{$data->descricao}' ,".
                                      " preco_custo = '{$data->preco_custo}' ,".
                                      " preco_venda = '{$data->preco_venda}' ,".
                                      " codigo_barras = '{$data->codigo_barras}' ,".
                                      " data_cadastro = '{$data->data_cadastro}' ,".
                                      " origem = '{$data->origem}'".
                                      " WHERE id = '{$data->id}'";

          }
          print " $sql ";
          return self::$conn->exec($sql);
        }

        public function getLastId()
        {
            $sql = "SELECT max(id) as max FROM Products";
            print " $sql <br>";
            $result = self::$conn->query($sql);

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