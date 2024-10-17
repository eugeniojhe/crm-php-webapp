<?php

namespace Control;

use General\Control\Action;
use General\Control\Page;
use General\Database\Transaction;
use General\Traits\DeleteTrait;
use General\Traits\EditTrait;
use General\Traits\ReloadTrait;
use General\Traits\SaveTrait;
use General\Widgets\Container\VBox;
use General\Widgets\Datagrid\Datagrid;
use General\Widgets\Datagrid\DatagridColumn;
use General\Widgets\Forms\Combo;
use General\Widgets\Forms\Entry;
use General\Widgets\Forms\Form;
use General\Widgets\Wrapper\DatagridWrapper;
use General\Widgets\Wrapper\FormWrapper;
use Model\Estado;

class CidadesFormList extends Page
{

    private $form;
    private $datagrid;
    private $loaded;
    private $connection;
    private $activeRecord;

    use EditTrait;
    use DeleteTrait;
    use ReloadTrait {
        onReload as onReloadTrait;
    }
    use SaveTrait {
        onSave as onSaveTrait;
    }
    public function __construct()
    {
        parent::__construct();

        $this->activeRecord = 'Model\Cidade';

        // instancia um formulário
        $this->form = new FormWrapper(new Form('form_cidades'));
        $this->form->setTitle('Cidades');

        // cria os campos do formulário
        $codigo    = new Entry('id');
        $descricao = new Entry('nome');
        $estado    = new Combo('id_estado');

        $codigo->setEditable(FALSE);

        Transaction::open();
        $estados = Estado::all();

        $items = array();
        foreach ($estados as $obj_estado)
        {
            $items[$obj_estado->id] = $obj_estado->nome;
        }
        Transaction::close();

        $estado->addItems($items);

        $this->form->addField('Código', $codigo, '30%');
        $this->form->addField('Descrição', $descricao, '70%');
        $this->form->addField('Estado', $estado, '70%');

        $this->form->addAction('Salvar', new Action(array($this, 'onSave')));
        $this->form->addAction('Limpar', new Action(array($this, 'onEdit')));

        // instancia a Datagrid
        $this->datagrid = new DatagridWrapper(new Datagrid);

        // instancia as colunas da Datagrid
        $codigo   = new DatagridColumn('id',     'Código', 'center', '10%');
        $nome     = new DatagridColumn('nome',   'Nome',   'left', '50%');
        $estado1   = new DatagridColumn('nome_estado', 'Estado', 'left', '40%');

        // adiciona as colunas à Datagrid

        $this->datagrid->addColumn($codigo);
        $this->datagrid->addColumn($nome);
        $this->datagrid->addColumn($estado1);

        $this->datagrid->addAction( 'Editar',  new Action([$this, 'onEdit']),   'id', ''); //fa fa-edit fa-lg blue
        $this->datagrid->addAction( 'Excluir', new Action([$this, 'onDelete']), 'id', ''); //fa fa-trash fa-lg red

        // monta a página através de uma tabela
        $box = new VBox;
        $box->style = 'display:block';
        $box->add($this->form);
        $box->add($this->datagrid);

        parent::add($box);
    }

    public function onReload()
    {
        $this->onReloadTrait();
        $this->loaded = true;
    }

    public function show()
    {
        // se a listagem ainda não foi carregada
        if (!$this->loaded)
        {
            $this->onReload();
        }
        parent::show();
    }

    public function onSave()
    {
        $this->onSaveTrait();
        $this->onReloadTrait();
    }

}