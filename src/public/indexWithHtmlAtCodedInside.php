<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

<?php
// Your class and method call
class Form {
    public $title = 'Sample Form';
    public $action = '/submit';
    public $fields = [
        ['label' => 'Name', 'type' => 'text', 'name' => 'name', 'value' => '', 'class' => 'form-control'],
        ['label' => 'Email', 'type' => 'email', 'name' => 'email', 'value' => '', 'class' => 'form-control']
    ];

    public function show() {
        echo "<div class='panel panel-default' style='margin: 40px'>\n";
        echo "<div class='panel-heading'>{$this->title}</div>\n";
        echo "<div class='panel-body'>";
        echo "<form method='POST' action='{$this->action}' class='form-horizontal'>\n";
        if ($this->fields) {
            foreach($this->fields as $field) {
                echo "<div class='form-group'>\n";
                echo "<label class='col-sm-2 control-label'>{$field['label']}</label>\n";
                echo "<div class='col-sm-10'>\n";
                echo "<input type='{$field['type']}' name='{$field['name']}' value='{$field['value']}' class='form-control {$field['class']}'/>\n";
                echo "</div>\n";
                echo "</div>\n";
            }
        }
        echo "</form>\n";
        echo "</div>\n";
        echo "</div>\n";
    }
}

// Create an instance of the form and display it
$form = new Form();
$form->show();
?>

</body>
</html>