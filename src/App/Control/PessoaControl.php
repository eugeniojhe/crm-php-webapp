<?php

namespace Control;

use General\Database\Transaction;
use General\Database\Repository;
use General\Database\Criteria;
use Model\Pessoa;
use General\Widgets\SimpleForm;

class PessoaControl extends PageControl
{
    public function list()
    {


        $simpleForm = new SimpleForm('Teste de formulãrio');
        $simpleForm->setTitle('Teste de Criação de formulário');
        $simpleForm->addField('Nome', 'nome', 'text', 'José Eugenio', 'form-control');
        $simpleForm->addField('Endereço', 'endereco', 'text', 'Rua Wilson Batista 83', 'form-control');
        $simpleForm->addField('Profissão', 'profissao', 'text', 'Developer web PHP', 'form-control');
        $simpleForm->show();
        die('Testando o formalário');

        $pessoas = array();
        try {
            Transaction::Open();

            $criteria = new Criteria();
//            $criteria->add('id', '=', 1);
            $criteria->setProperty('order', 'id');
            $repository = new Repository(new Pessoa());
            $pessoas =  $repository->load($criteria);

            Transaction::Close();

            echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Código</th>";
                echo "<th>Nome</th>";
                echo "</thead>";


            foreach ($pessoas as $pessoa) {
                echo "<tr>";
                echo "<td>$pessoa->id</td>";
                echo "<td>$pessoa->name</td>";
                echo "</tr>";
            }

            echo "</table>";

        } catch (\Exception $e) {
            print $e->getMessage();
        }
        return $pessoas;
    }
}