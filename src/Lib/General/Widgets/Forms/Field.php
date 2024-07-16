<?php

namespace General\Widgets\Forms;

abstract class Field Implements FormElementInterface
{
    protected $name;
    protected $value;
    protected $properties;
    protected $editable;
    protected $size;
    protected $formLabel;
    public function __construct($name)
    {
        $this->setEditable(true);
        $this->setName($name);
    }

    public function setEditable(bool $editable)
    {
        $this->editable = $editable;
    }

    public function getEditable()
    {
        return $this->editable;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __set($name, $value)
    {
        if (is_scalar($value)) {
            $this->setProperty($name, $value);
        }
    }
    public function __get($name)
    {
        return $this->getProperty[$name];
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
    public function getProperty($name)
    {
        return $this->properties[$name] ?? null;
    }

    public function setProperty($name, $value)
    {
        $this->properties[$name] = $value;
    }

    public function setSize($width, $heigth = null)
    {
        $this->size = $width;
    }

    public function setLabel($label)
    {
        $this->formLabel = $label;
    }

    public function getLabel()
    {
        return $this->formLabel;
    }
}