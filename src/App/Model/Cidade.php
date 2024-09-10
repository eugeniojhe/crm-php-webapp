<?php

namespace Model;

use General\Database\Record;

class Cidade extends Record
{
    const TABLENAME = 'cidades';
    private object $estado;


    public function get_estado(): string
    {
        if (empty($this->estado)) {
            $this->estado = new Estado($this->estado_id);
        }

        return $this->estado;
    }

    public function get_nome_estado(): string
    {
        if (empty($this->estado)) {
            $this->estado = new Estado($this->estado_id);
        }

        return $this->estado->nome;
    }
}