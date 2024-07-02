<?php

namespace General\Widgets\Wrapper;
use General\Widgets\Forms\Form;
use General\Widgets\Element;

class FormWrapper
{
    private $decorator;

    public function __construct(Form $form)
    {
        $this->decorator = $form;
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->decorator, $method], $arguments);
    }

    public function show()
    {
        $element = new Element('form');
        $element->class = 'form-horizontal';
        $element->enctype = 'multipart/form-data';
        $element->method = 'POST';
        $element->name = $this->decorator->getName();
        $element->width = '100%';

        foreach ($this->decorator->getFields() as $field) {
            $group = new Element('div');
            $group->class = 'form-group';

            $label = new Element('label');
            $label->class = 'col-sm-2 control-label';
            $label->add($field->getLabel());

            $col = new Element('div');
            $col->class = 'col-sm-10';
            $col->add($field);
            $field->class = 'form-control';

            $group->add($label);
            $group->add($col);
            $element->add($group);
        }

        $footer = new Element('div');
        $i = 0;
        foreach ($this->decorator->getActions() as  $label => $action) {
            $name = strtolower(str_replace('_', ' ', $label));
            $button = new Button($name, $action);
            $button->setFormName($this->decorator->getName());
            $button->setAction($action, $label);
            $button->class = 'btn ' . ( ($i ==0)  ?  'btn-sucess' : 'btn-default');
            $footer->add($button);
            $i++;
        }

        $panel = new Panel($this->decorator->getTitle());
        $panel->add($element);
        $panel->addFooter($footer);
        $panel->show();
    }
}