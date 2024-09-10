<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TableFuncionario extends CreateTable
{

       const TABLE = "funcionarios";
       const FIELDS = [
           'id INT(11) AUTO_INCREMENT PRIMARY KEY',
           'nome VARCHAR(255) NOT NULL',
           'email VARCHAR(255) NOT NULL',
           'telefone VARCHAR(255)',
           'departamento VARCHAR(255)',
           'contracao VARCHAR(255)',
           'cidade VARCHAR(255)',
           'estado VARCHAR(255)',
           'endereco VARCHAR(255)',
           'idiomas VARCHAR(255)',
           'contratacao INT(2)'
       ];

}