<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TableProduto extends CreateTable
{
    const TABLE = "produtos";

    const FIELDS = [
        'id INT(11) PRIMARY KEY AUTO_INCREMENT',
        'descricao VARCHAR(255) NOT NULL',
        'estoque FLOAT',
        'preco_custo DECIMAL(10,2) NOT NULL',
        'preco_venda DECIMAL(10,2) NOT NULL',
        'id_fabricante INT(11) NOT NULL',
        'id_unidade INT(11) NOT NULL',
        'id_tipo INT(11) NOT NULL',
        'CONSTRAINT produtos_id_fabricante_fk FOREIGN KEY (id_fabricante) REFERENCES fabricantes(id)',
        'CONSTRAINT produtos_id_unidade_fk FOREIGN KEY (id_unidade) REFERENCES unidades(id)',
        'CONSTRAINT produtos_id_tipo_fk FOREIGN KEY (id_tipo) REFERENCES tipos(id)',
    ];
}