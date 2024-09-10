<?php
namespace General\Widgets\Container;
use General\Widgets\Element;
use Twig\Node\Expression\ParentExpression;


class Panel extends Element
{

    private $body = null;
    private $footer = null;

    private $class = null;

    public function __construct($panelTitle  = null)
    {
        parent::__construct('div');
        $panelTitle = 'Pessoas';
        $panel = new Element('div');
        $panel->clas = 'panel panel-success';
        if ($panelTitle){

            $head = new Element('div');
            $head->class = 'panel-heading';

            $title = new Element('div');
            $title->class = 'panel-title';

            $label = new Element('h4');
            $label->add($panelTitle);

            $title->add($label);
            $head->add($title);
            $panel->add($head);
        }

        $this->body = new Element('div');
        $this->body->class = 'panel-body';

        $this->footer = new Element('div');
        $this->footer->class = 'panel-footer';

        $panel->add($this->body);
        Parent::add($panel);

        $this->footer = new Element('div');
        $this->footer->{'class'} = 'panel-footer';
    }

    public function add($content)
    {
        $this->body->add($content);
    }

    public function addFooter($footer)
    {
        $this->footer->add($footer);
        return $this->footer;
    }
}