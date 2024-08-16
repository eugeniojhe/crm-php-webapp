<?php

namespace General\Widgets\Datagrid;

use General\Control\ActionInterface;

class Datagrid
{
    private $columns;
    private $items;
    private $actions;
       public function addColumn(DatagridColumn $obj)
       {
            $this->columns [] = $obj;
       }

       public function addAction($label, ActionInterface $action, $field, $image = null)
       {
            $this->actions[] = [
                'label' => $label,
                'action' => $action,
                'field' => $field,
                'image' => $image
            ];
       }

       public function addItem($obj)
       {
            $this->items[] = $obj;
            foreach ($this->columns as $column) {
                $name = $column->getName();

                if(!isset($obj->$name)) {
                    $obj->$name;
                }
            }
       }

       public function getColumns()
       {
            return $this->columns;
       }

       public function getItems()
       {
           return $this->items;
       }

       public function getActions()
       {
           return $this->actions;
       }

       public function clear()
       {
           $this->items = [];
       }
}