<?php

namespace Model;

use General\Database\Record;
use Model\PessoaGrupo;
use General\Database\Criteria;
use General\Database\Repository;

class Pessoa extends Record
{
    const TABLENAME = "pessoas";
    private $cidade;

    public function get_cidade()
    {
        if (is_null($this->cidade)) {
            $this->cidade = new Cidade($this->id_cidade);

        }
        return $this->cidade;
    }

    public function get_nome_cidade()
    {
        if (is_null($this->cidade)) {
            $this->cidade = new Cidade($this->id_cidade);
        }
        return $this->cidade->nome;
    }

    public function addGrupo(Grupo $grupo)
    {
        $pg = new PessoaGrupo();
        $pg->id_grupo = $grupo->id;
        $pg->id_pessoa = $this->id;
        $pg->store();
    }

    public function delGrupos()
    {
        $criteria = new Criteria();
        $criteria->add('id_pessoa', '=' , $this->id);
        $repo = new Repository("Model\PessoaGrupo");
        $repo->delete($criteria);
    }

    public function getGrupos()
    {
        $grupos = array();
        $criteria = new Criteria();
        $criteria->add('id_pessoa', '=', $this->cidade);
        $repo = new Repository('PessoaGrupo');
        $vinculos = $repo->load($criteria);
        if (!empty($vinculos)) {
            foreach ($vinculos as $vinculo) {
                $grupos[] = new Grupo($vinculo->id);

            }
        }
        return $grupos;
    }
}