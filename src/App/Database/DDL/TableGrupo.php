<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TableGrupo extends CreateTable
{
    const TABLE = "grupos";

    const FIELDS = [
       'id INT(11) PRIMARY KEY AUTO_INCREMENT',
        'nome TEXT',
    ];
}