<?php

namespace General\Control;

interface ActionInterface
{
    public function setParameter($param, $value);
    public function serialize();
}