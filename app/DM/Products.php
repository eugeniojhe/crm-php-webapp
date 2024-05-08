<?php

namespace DM;

class Products
{
    private $data;

    public function __set($property, $value)
    {
        $this->data[$property] = $value;

    }

    public function __get($property)
    {
        return $this->data[$property];
    }


}