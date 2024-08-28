<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TableUnidade extends CreateTable
{
    const TABLE = "unidades";

    const FIELDS = [
       'id INT(11) PRIMARY KEY AUTO_INCREMENT',
        'sigla CHAR(3) NOT NULL',
        'nome VARCHAR(256) NULL'
    ];
}