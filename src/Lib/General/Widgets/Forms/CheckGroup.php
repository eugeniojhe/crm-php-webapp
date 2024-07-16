<?php

namespace General\Widgets\Forms;

use General\Widgets\Element;

class CheckGroup extends Field implements FormElementInterface
{
    private $layout = 'vertical';
    private $items;

    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    public function addItems($items)
    {
        $this->items = $items;
    }


    public function show()
    {
       if ($this->items !== null) {
           $button = new CheckButton("{$this->name}");
           foreach ($this->items as $index => $label) {
               $button->setValue($index);
               if (in_array($index, (array) $this->value))
               {
                 $button->setProperty('checked', 'checked');
               }

               $obj = new Label($label);
               $obj->add($button);
               $obj->show();
               if ($this->layout == 'vertical') {
                   $br = new Element("br");
                   $br->show();
                   echo "\n";
               }

           }
       }
    }
}