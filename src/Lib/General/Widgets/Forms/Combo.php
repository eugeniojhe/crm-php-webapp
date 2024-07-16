<?php

namespace General\Widgets\Forms;
use General\Widgets\Element;

class Combo extends Field
{
    private $items;
    protected $properties;

    public function addItems($item)
    {
        $this->items = $item;
    }

    public function show()
    {
      $tag = new Element('select');
      $tag->class = 'combo';
      $tag->name = $this->name;
      $tag->style = "width: {$this->size}";

      $option = new Element('option');
      $option->add('');
      $option->value = 0;

      $tag->add($option);
      if ($this->items)
      {
          foreach ($this->items as $key => $item) {
            $option = new Element('option');
            $option->value = $key;
            $option->add($item);

            if ($key == $this->value)
            {
               $option->selected = 1;
            }
            $tag->add($option);

          }
      }

        if (!parent::getEditable())
        {
            $tag->readonly = 1;
        }

        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->{$property} = $value;
            }
        }

        $tag->show();

    }
}