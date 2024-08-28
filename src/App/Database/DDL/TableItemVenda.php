<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TableItemVenda extends CreateTable
{
    const TABLE = "item_vendas";

    const FIELDS = [
        'id INT(11) PRIMARY KEY AUTO_INCREMENT',
        'id_produto INT(11) NOT NULL',
        'id_venda INT(11) NOT NULL',
        'quantidade DECIMAL(11,2) NOT NULL',
        'preco DECIMAL (11,2) NOT NULL',

        'CONSTRAINT itens_vendas_id_produto_fk FOREIGN KEY (id_produto) REFERENCES produtos(id)',
        'CONSTRAINT itens_vendas_id_venda_fk FOREIGN KEY (id_venda) REFERENCES vendas(id)',
    ];
}