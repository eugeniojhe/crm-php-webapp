<?php

namespace General\Widgets\Wrapper;

use General\Widgets\Datagrid\Datagrid;
use General\Widgets\Element;
use General\Widgets\Container\Panel;

class DatagridWrapper
{
    private $decorated;

    public function __construct(Datagrid $decorate)
    {
        $this->decorated = $decorate;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->decorated, $name], $arguments);
    }


    public function __set($attribute, $value)
    {
        $this->decorated->$attribute = $value;
    }

    public function show()
    {
        $element = new Element('table');
        $element->class = 'table table-stripped table-hover';

        $thead = new Element('thead');
        $element->add($thead);
        $this->createHeaders($thead);

        $tbody = new Element('tbody');
        $element->add($tbody);

        $items = $this->decorated->getItems();
        if ($items) {
            foreach ($items as $item)
            {
                $this->createItem($tbody, $item);
            }
        }

        $panel = new Panel;
        $panel->type = 'datagrid';
        $panel->add($element);
        $panel->show();

    }

    public function createHeaders(Element $thead)
    {
        $row = new Element('tr');
        $thead->add($row);
        $actions = $this->decorated->getActions();
        $columns = $this->decorated->getColumns();
        if ($actions) {
            foreach ($actions as $action) {
                $celula = new Element('th');
                $celula->width = '4px';
//                $celula->add($action);
                $row->add($celula);
            }
        }

        if ($columns) {
            foreach ($columns as $column) {
                $label = $column->getLabel();
                $align = $column->getAlign();
                $width = $column->getWidth();

                $celula = new Element('th');
                $celula->add($label);
                $celula->style = 'text-align:' . $align . ';';
                $celula->width  = $width;
                $row->add($celula);

                if ($column->getAction()) {
                    $url = $column->getAction();
                    $celula->onclick = 'document.location.href = "' . $url . '";';
                    $row->add($celula);
                }
            }
        }

    }

    public function createItem($tbody, $item)
    {
        $row = new Element('tr');
        $tbody->add($row);

        $actions = $this->decorated->getActions();
        $columns = $this->decorated->getColumns();
        if ($actions) {
            foreach ($actions as $action) {
                $url = $action['action']->serialize();
                $label = $action['label'];
                $image = $action['image'];
                $field = $action['field'];

                $key = $item->$field;

                $link = new Element('a');
                $link->href = "{$url}&{$field}={$key}";

                if ($image) {
                    $i = new Element('img');
                    $i->class = $image;
                    $i->title = $label;
                    $i->add('');
                    $link->add($i);
                } else {
                    $link->add($label);
                }

                $element = new Element('td');
                $element->add($link);
                $element->align = 'center';

                // adiciona a célula à linha
                $row->add($element);

            }
        }

        if ($columns)
        {
            // percorre as colunas da Datagrid
            foreach ($columns as $column)
            {
                // obtém as propriedades da coluna
                $name     = $column->getName();
                $align    = $column->getAlign();
                $width    = $column->getWidth();
                $function = $column->getTransformer();
                $data     = $item->$name;

                // verifica se há função para transformar os dados
                if ($function)
                {
                    // aplica a função sobre os dados
                    $data = call_user_func($function, $data);
                }

                $element = new Element('td');
                $element->add($data);
                $element->align = $align;
                $element->width = $width;

                // adiciona a célula na linha
                $row->add($element);
            }
        }

    }
}