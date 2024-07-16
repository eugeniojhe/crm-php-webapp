<?php

namespace General\Widgets\Forms;

use General\Widgets\Element;

class Text extends Field
{

    private $width;
    private $height = '100';

    public function setSize($width, $height = null)
    {
        $this->size = $width;
        if (isset($height)) {
            $this->height = $height;
        }
    }



    public function show()
    {
        $tag = new Element('textarea');
        $tag->class = 'field';
        $tag->name = $this->name;
        $tag->style = 'width: {$this->size}; height: {$this->height};';

        if (!parent::getEditable()) {
            $this->readonly = 1;
        }

        $tag->add(htmlspecialchars((string) $this->value));
        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->$property = $value;
            }
        }
        $tag->show();

    }
}