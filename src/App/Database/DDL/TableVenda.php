<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TableVenda extends CreateTable
{
    const TABLE = "vendas";

    const FIELDS = [
        'id INT(11) PRIMARY KEY AUTO_INCREMENT',
        'id_cliente INT(11) NOT NULL',
        'data_venda DATETIME NOT NULL',
        'valor_total DOUBLE(11,2) NOT NULL',
        'desconto DOUBLE(11,2) NULL',
        'acrescimo DOUBLE(11,2) NULL',
        'valor_final DOUBLE(11,2) NULL',
        'observacoes TEXT NULL',
        'CONSTRAINT vendas_id_cliente_fk FOREIGN KEY (id_cliente) REFERENCES pessoas(id)',
    ];
}