<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TableTipo extends CreateTable
{
    const TABLE = "tipos";

    const FIELDS = [
       'id INT(11) PRIMARY KEY AUTO_INCREMENT',
       'nome VARCHAR(256) NULL'
    ];
}