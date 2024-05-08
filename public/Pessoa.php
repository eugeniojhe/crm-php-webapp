<?php

namespace  APP\Eugenio;
require_once 'Record.php';
require_once 'JSONExporter.php';
class Pessoa extends Record
{
    const TABLE = 'pessoas';

    public function toJson()
    {
        $je = New JSONExporter();
        return $je->exporter($this->data);
    }

}

$p = new Pessoa;
$p->nome = "Roberto Carlos Canto";
$p->endereco = "Rua do comercio";
$p->numero = "10";

print($p->toJson());
