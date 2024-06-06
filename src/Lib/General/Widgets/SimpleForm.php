<?php

namespace General\Widgets;

class SimpleForm
{

    private $name;
    private $title;
    private $fields;
    private $action;
    private $method ;


    public function __construct($name)
    {
        $this->name = $name;
        $this->fields = [];
        $this->title = '';
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function addField($label, $name, $type, $value, $class = null, $required = false)
    {
        $this->fields[] = [
            'label' => $label,
            'name' => $name,
            'type' => $type,
            'value' => $value,
            'class' => $class,
            'required' => $required,
        ];

    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function show()
    {
        echo "<div class='panel panel-default' style='margin: 40px'>\n";
            echo "<div class='panel-heading'>{$this->title}</div>\n";
            echo "<div class='panel-body'>";
                echo "<form method='POST' action='{$this->action}' class='form-horizontal'>\n";
                    if ($this->fields) {
                        foreach($this->fields as $field) {
                            echo "<div class='form-group'>\n";
                              echo "<label class='col-sm-2 control-label'>{$field['label']}</label>\n";
                              echo "<div class='col-sm-10'>\n";
                                 echo "<input type='{$field['type']}' name='{$field['name']}' value='{$field['value']}' class='{$field['class']}'". ($field['required'] ? 'required' : '')."/>\n";
                              echo "</div>\n";

                            echo "</div>\n";
                        }

                    }
                echo "<div class=form-group>\n";
                    echo "<div class='col-sm-offset-2 col-sm-10'>\n";
                          echo "<button type='submit' class='btn btn-success'>Enviar</button>";
                    echo "</div>\n";
                echo "</div>\n";
                echo "</form>\n";
            echo "</div>\n";

        echo "</div>\n";
    }

}