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
use General\Widgets\Forms\Entry;
use General\Widgets\Forms\Form;
use General\Widgets\Wrapper\DatagridWrapper;
use General\Widgets\Wrapper\FormWrapper;
use Model\Fabricante;

class FabricantesFormList extends Page
{
    private $form;
    private $datagrid;
    private $loaded;
    private $connection;
    private $activeRecord;

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
        $this->activeRecord = Fabricante::class;

        $this->form = new FormWrapper( new Form('fabricante_form') );
        $this->form->setTitle('Fabricantes');

        $codigo = new Entry('id');
        $nome = new Entry('nome');
        $site = new Entry('site');
        $codigo->setEditable(false);


        $this->form->addField('Código', $codigo, '30%');
        $this->form->addField('Nome', $nome, '70%');
        $this->form->addField('Site', $site, '70%');

        $this->form->addAction('Salvar', new Action(array($this, 'onSave')));
        $this->form->addAction('Excluir', new Action(array($this, 'onDelete')));

        $this->datagrid = new DataGridWrapper(new DataGrid());

        $codigo = new DataGridColumn('id', 'Código', 'center', '10%');
        $nome = new DataGridColumn('nome', 'Nome', 'left', '30%');
        $site = new DataGridColumn('site', 'Site', 'left', '30%');

        $this->datagrid->addColumn($codigo);
        $this->datagrid->addColumn($nome);
        $this->datagrid->addColumn($site);

        $this->datagrid->addAction('Editar', new Action(array($this, 'onEdit')), 'id', '');
        $this->datagrid->addAction('Excluir', new Action([$this, 'onDelete']), 'id', '');

        $box = new VBox;
        $box->style = 'display:block';
        $box->add($this->form);
        $box->add($this->datagrid);

        parent::add($box);
    }

    public function onSave()
    {
        $this->onSaveTrait();
        $this->onReload();
    }

    public function onReload()
    {
        $this->onReloadTrait();
        $this->loaded = true;
    }

    public function onEdit($param)
    {
        if (isset($param['id'])) {
            $key = $param['id'];
            Transaction::open();
            $fabricante = Fabricante::find($key);
            $this->form->setData($fabricante);
            Transaction::close();
            $this->onReload();
        }
    }

    public function show()
    {
        if (!$this->loaded) {
            $this->onReload();
        }

        parent::show();
    }

}