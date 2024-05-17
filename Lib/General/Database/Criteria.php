<?php

namespace General\Database;

class Criteria
{
    private $filters;
    private $properties;
    public function __construct()
    {
        $this->filters = [];
    }

    public function add($variable, $compare, $value, $logic_op = "AND")
    {
       if(empty($this->filters))  {
           $logic_op = null;
       }

        $this->filters[] = [$variable, $compare, $this->transform($value), $logic_op];
    }


    private function transform($value)
    {
        if (is_array($value)) {
            foreach ($value as $v) {
                if (is_integer($v)) {
                    $foo[] = $v;
                } else if (is_string($v)) {
                    $foo[] = "'$v'";
                }
            }
            $result = '(' . implode(',', $foo) . ')';
        } else if (is_string($value)) {
            $result = "'$value'";
        } else if (is_bool($value)) {
            $result = $value ? 'TRUE' : 'FALSE';
        } else if (is_null($value)) {
            $result = NULL;
        } else if (is_integer($value)) {
            $result = $value;
        } else if (is_float($value)) {
            $result = $value;
        }
        return $result;
    }


    public function dump()
    {
        $result = '';
        if (is_array($this->filters) and count($this->filters) > 0) {
            $result = ' ';

            foreach($this->filters as $f) {
                $result .= $f[3].' '.$f[0] . ' '.$f[1] . ' '.$f[2]. ' ';
            }

            $result = trim($result);
            return "({$result})";
        }
        return $result;
    }

    public function setProperty($property, $value)
    {
        $this->properties[$property] = $value;
    }

    public function getProperty($property)
    {
        if (!empty($this->properties[$property])) {
            return $this->properties[$property];
        }

    }
}