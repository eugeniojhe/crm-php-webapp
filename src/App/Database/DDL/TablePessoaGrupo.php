<?php

namespace Database\DDL;

use General\Database\CreateTable;

class TablePessoaGrupo extends CreateTable
{
    const TABLE = "pessoa_grupos";

    const FIELDS = [
        'id INT(11) PRIMARY KEY AUTO_INCREMENT',
        'id_grupo INT(11) NOT NULL',
        'id_pessoa INT(11) NOT NULL',
        'CONSTRAINT pessoas_grupos_id_pessoa_fk FOREIGN KEY (id_pessoa) REFERENCES pessoas(id)',
        'CONSTRAINT pessoas_grupos_id_grupo_fk FOREIGN KEY (id_grupo) REFERENCES  grupos(id)',
    ];
}