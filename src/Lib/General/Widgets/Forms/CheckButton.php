<?php

namespace General\Widgets\Forms;
use General\Widgets\Element;

class CheckButton extends field implements FormElementInterface
{
    public function show()
    {
        $tag = new Element("input");
        $tag->class = 'field';
        $tag->name = $this->name;
        $tag->value = $this->value;
        $tag->type = "checkbox";

        if (!parent::getEditable())
        {
            $tag->readonly = "1";
        }

        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->{$property} = $value;
            }
        }


        $tag->show();
    }
}