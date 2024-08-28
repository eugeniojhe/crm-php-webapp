<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TableFabricante extends CreateTable
{
    const TABLE = "fabricantes";

    const FIELDS = [
       'id INT(11) PRIMARY KEY AUTO_INCREMENT',
        'nome varchar(255) NOT NULL',
        'site VARCHAR(256) NULL'
    ];
}