<?php

namespace Model;

use Exception;
use General\Database\Record;

class Cidade extends Record
{
    const TABLENAME = 'cidades';
    private  $estado;
    public function get_estado():object
    {
        if (empty($this->estado)) {
            $this->estado = new Estado($this->id_estado);
        }
        return $this->estado;
    }

    public function get_nome_estado():mixed
    {
        if (empty($this->estado)) {
            if ($this->id_estado) {
                $this->estado = new Estado($this->id_estado);
                return $this->estado;

            } else {
                return 'Estado não encontrado';
            }
        }
        if (!$this->estado->nome) {
            return 'Estado não encontrado!';
        }
        return $this->estado->nome;
    }
}