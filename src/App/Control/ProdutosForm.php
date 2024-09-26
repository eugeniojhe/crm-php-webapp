<?php

namespace Control;

use General\Control\Action;
use General\Control\Page;
use General\Database\Transaction;
use General\Traits\EditTrait;
use General\Traits\SaveTrait;
use General\Widgets\Forms\Combo;
use General\Widgets\Forms\Entry;
use General\Widgets\Forms\Form;
use General\Widgets\Forms\RadioGroup;
use General\Widgets\Wrapper\FormWrapper;
use Model\Fabricante;
use Model\Tipo;
use Model\Unidade;

class ProdutosForm extends Page
{
    private $form;
    private $class;
    private $dados;
    private $connection;
    private $activeRecord;

    use SaveTrait;
    use EditTrait;
    public function __construct()
    {
        parent::__construct();
        $this->activeRecord = "Model\Produto";
        $this->form = new FormWrapper(new Form('form_produtos'));
        $this->form->setTitle('Produtos');

        $codigo = new Entry('id');
        $descricao = new Entry('descricao');
        $estoque = new Entry('estoque');
        $preco_custo = new Entry('preco_custo');
        $preco_venda = new Entry('preco_venda');
        $fabricante = new Combo('id_fabricante');
        $tipo = new RadioGroup('id_tipo');
        $unidade  = new Combo('id_unidade');

        Transaction::open();
        $fabricantes = Fabricante::all();
        $items = array();

        foreach ($fabricantes as $ob_fabricante) {
            $items[$ob_fabricante->id] = $ob_fabricante->nome;
        }
        $fabricante->addItems($items);

        $tipos = Tipo::all();
        $items = array();

         foreach ($tipos as $ob_tipo) {
             $items[$ob_tipo->id] = $ob_tipo->nome;
         }
         $tipo->addItems($items);

         $unidades = Unidade::all();
         $items = array();
         foreach ($unidades as $ob_unidade) {
             $items[$ob_unidade->id] = $ob_unidade->nome;
         }
         $unidade->addItems($items);
        $codigo->setEditable(FALSE);

        $this->form->addField('Código', $codigo, '30%');
        $this->form->addField('Descricao', $descricao, '70%');
        $this->form->addField('Estoque', $estoque, '70%');
        $this->form->addField('Preco custo', $preco_custo, '70%');
        $this->form->addField('preco venda', $preco_venda, '70%');
        $this->form->addField('Fabricante', $fabricante, '70%');
        $this->form->addField('Tipo', $tipo, '70%');
        $this->form->addField('Unidade', $unidade, '70%');
        $this->form->addAction('Salvar', new Action(array($this, 'onSave')));

        parent::add($this->form);

        Transaction::close();
    }

}
