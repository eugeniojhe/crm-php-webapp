<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TableEstado extends CreateTable
{
    const TABLE = "estados";

    const FIELDS = [
       'id INT(11) PRIMARY KEY AUTO_INCREMENT',
       'sigla CHAR(2) NOT NULL',
       'nome TEXT NOT NULL',
    ];
}