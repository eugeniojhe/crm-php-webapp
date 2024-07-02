<?php

namespace General\Widgets\Forms;
use General\Control\ActionInterface;


class Form implements FormElementInterface
{
    protected $name;
    protected $title;
    protected $fields;
    protected $actions;
    public function __construct($name = "My_form")
    {
        $this->name = $name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getTitle() {
        return $this->title;
    }

    public function addFields($label, FormElementInterface $object, $size = '100%')
    {
        $object->setSize($size);
        $object->setLabel($label);
        $this->fields[$object->getName()] = $object;
    }


    public function getFields()
    {
        return $this->fields;
    }

    public function addActions($label, ActionInterface $action)
    {
        $this->actions[$label] = $action;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function setData($object)
    {
        foreach ($this->getFields() as $name => $field) {
            if ($name AND isset($object->$name)) {
                $field->setValue($object->$name);
            }
        }
    }

    public function getData($type = 'stdClass')
    {
        $object = new $type;
        foreach ($this->getFields() as $name => $field) {
            $value = isset($_POST[$name]) ? $_POST[$name] : null;
            $object->$name = $value;
        }

        return $object;
    }

}