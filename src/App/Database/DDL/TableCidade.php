<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TableCidade extends CreateTable
{
    const TABLE = "cidades";

    const FIELDS = [
       'id INT(11) PRIMARY KEY AUTO_INCREMENT',
        'nome TEXT NOT NULL',
        'id_estado INT(11)',
        'CONSTRAINT estados_id_estado_fk FOREIGN KEY (id_estado) REFERENCES estados(id)',
    ];
}