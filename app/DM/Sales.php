<?php

namespace DM;

class Sales
{
    private $id;
    private $items;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function addItem($quantidade, Products $product)
    {
        $this->items[] = [$quantidade, $product];
    }

    public function getItems()
    {
        return $this->items;
    }
}