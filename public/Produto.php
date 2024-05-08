<?php
require_once 'Record.php';
require_once 'ObjectConversionTrait.php';
class Produto extends Record
{
    const TABLENAME = "produto";
    use ObjectConversionTrait;

}