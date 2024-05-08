<?php

namespace APP\Record;
class Record
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

     public function save()
     {
         return "INSERT INTO " . $this::TABLENAME .
             ' ('  .implode(', ', array_keys($this->data)) .')' .
             ' VALUES '."('" . implode(" ', '", array_values($this->data)). "')" ;
     }

     public function load($id)
     {
         return 'SELECT * FROM '.$this::TABLENAME .' WHERE id = '.$id;
     }

     public function delete($id)
     {
         return 'DELETE FROM '.$this::TABLENAME .' WHERE id = '.$id;
     }
}

//class Produto extends Record
//{
//    const TABLENAME = "produto";
//}

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
