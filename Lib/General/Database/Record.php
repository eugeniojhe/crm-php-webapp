<?php

namespace General\Database;


//use PHPMailer\PHPMailer\Exception;

abstract class Record
{
    private $data;

    public function __construct($id = null)
    {
        if ($id) {
            $object = $this->load($id);
            if ($object) {
                $this->fromArray( $object->toArray() );
            }
        }
    }

    public function __set($property, $value)
    {
        if ($value === null) {
            unset($this->data[$property]);
        } else {
            $this->data[$property] = $value;
        }
    }

    public function __get($property)
    {
        if (isset($this->data[$property])) {
            return $this->data[$property];
        }
        return null;
    }

    public function __isset($property) {
        return isset($this->data[$property]);
    }

    public function __clone()
    {
        unset($this->data['id']);
    }

    public function fromArray($data)
    {
        $this->data = $data;
    }

    public function toArray()
    {
        return $this->data;
    }

    public function getEntity()
    {
        $class = get_class($this);
        return constant("{$class}::TABLENAME");
    }

    public function load($id)
    {
        $sql = "SELECT * FROM {$this->getEntity()} WHERE id = ". (int) $id;
        if ($conn = \Transaction::get()) {
            \Transaction::log($sql);
            $result =  $conn->query($sql);
            if ($result) {
                return $result->fetchObject( get_class($this));
            }
        } else {
            throw new Exception('Não existe conexão ativa');
        }
        return false;
    }

     public function find($id)
     {
         return $this->load($id);
     }
//     public static function find($id)
//     {
//         $className = get_called_class();
//         $obj = new $className($id);
//         return $obj->load($id);
//     }
    public function delete($id = null)
    {
        $id = $id ? $id : $this->data['id'];

        $sql = "DELETE FROM {$this->getEntity()} WHERE id = ". (int) $id;
        if ($conn = \Transaction::get()) {
            \Transaction::log($sql);
            $result = $conn->exec($sql);
        } else  {
            throw new Exception('Não existe conexão ativa');
        }
    }

    public function store()
    {
        if (empty($this->data['id']) OR (!$this->load($this->data['id']))) {
            $prepared = $this->prepare($this->data);
            if (empty($prepared['id'])) {
                $this->data['id'] = $this->getLastId() + 1;
                $prepared['id'] =  $this->data['id'];
            }
            $sql = "INSERT INTO {$this->getEntity()}" .
                '(' . implode(', ', array_keys($prepared)) . ')' .
                ' VALUES ' .
                '(' . implode(', ', array_values($prepared)) . ')';
        } else {
            $prepared = $this->prepare($this->data);
            $set = [];
            foreach ($prepared as $column => $value) {
                $set[] = "$column = $value";
            }
            $sql = "UPDATE {$this->getEntity()}";
            $sql .= " SET " . implode(',', $set);
            $sql .= " WHERE id = " . (int) $this->data['id'];
        }
        Transaction::log($sql);
        if ($conn = \Transaction::get()) {
            $result = $conn->exec($sql);
        } else {
            throw new Exception('Não existe conexão ativa com a base de dados');
        }
    }

    public function getLastId()
    {
        $sql = "SELECT max(id)  as max FROM {$this->getEntity()}";
        if ($conn = \Transaction::get()){
            \Transaction::log($sql);
            $result = $conn->query($sql);
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
        } else {
            throw new Exception('Conexão com o Banco de Dados não existe');
        }
    }

    public function prepare($data)
    {
        $prepared = array();
        foreach($data as $key => $value) {
            if (is_scalar($value)) {
                $prepared[$key] = $this->scapeValue($value);
            }
        }
        return $prepared;
    }

    private function scapeValue($value)
    {
        if (is_string($value) and (!empty($value))) {
            $value  = addslashes($value);
            return "'$value'";
        }
        else if (is_bool($value)) {
            return $value ? 'TRUE' : 'FALSE';
        } else  if ($value !== '') {
            return $value;
        } else {
            return "NULL";
        }

    }
}