<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TableConta extends CreateTable
{
    const TABLE = "contas";

    const FIELDS = [
        'id INT(11) PRIMARY KEY AUTO_INCREMENT',
        'id_cliente INT(11) NOT NULL',
        'dt_emissao DATETIME NOT NULL',
        'dt_vencimento DATETIME NOT NULL',
        'vl_total INT(11) NOT NULL',
        'paga CHAR(1) NOT NULL',
        'CONSTRAINT contas_id_cliente_fk FOREIGN KEY (id_cliente) REFERENCES pessoas(id)',
    ];
}