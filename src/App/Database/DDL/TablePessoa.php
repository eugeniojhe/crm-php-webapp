<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TablePessoa extends CreateTable
{
    const TABLE = "pessoas";

    const FIELDS = [
        'id INT(11) PRIMARY KEY AUTO_INCREMENT',
        'nome VARCHAR(255) NOT NULL',
        'email VARCHAR(255) NOT NULL',
        'telefone VARCHAR(255) NOT NULL',
        'endereco VARCHAR(255) NOT NULL',
        'bairro VARCHAR(255) NOT NULL',
        'id_cidade INT(11) NOT NULL',
        'CONSTRAINT pessoas_id_cidade_fk FOREIGN KEY (id_cidade) REFERENCES cidades(id)',
    ];
}