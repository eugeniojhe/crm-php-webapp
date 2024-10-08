<?php

namespace General\Widgets;

class Element
{

    private $tagName;
    protected $properties;
    private $children;
    public function __construct($tagName)
    {
        $this->tagName = $tagName;
        $this->children = [];
    }

    public function __set($name, $value)
    {
        $this->properties[$name]  = ($this->properties[$name] ?? '') . $value. '';
    }


    public function __get($name)
    {
        return isset($this->properties[$name]) ?? null;
    }

    public function add($child)
    {
        $this->children[] = $child;
    }

    public function open()
    {

        if ($this->tagName) {
            echo "<{$this->tagName}";
            echo "\n";
            if ($this->properties) {
                foreach ($this->properties as $name => $value) {
                    if (is_scalar($value)) {
                        echo "{$name} =\"{$value}\"";
                        echo "\n";
                    }
                }
            }

            echo ">";
        }

    }

    public function show()
    {
        $this->open();
        echo "\n";
        if ($this->children)
        {
            foreach($this->children as $child) {
               if (is_object($child)){
                   $child->show();
               }
               else if (is_string($child) or is_numeric($child))
               {
                    echo $child;
               }
            }
        }

        $this->close();
    }

    public function __toString()
    {
        ob_start();
        $this->show();
        $content = ob_get_clean();
        return $content;
    }
    public function close()
    {
        echo "</{$this->tagName}>\n";
    }
}