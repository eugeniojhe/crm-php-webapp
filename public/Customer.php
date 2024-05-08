<?php

///namespace APP\Eugenio;

class Customer
{
    public function __construct()
    {
        echo "Inside construct of Customer classs";
    }
}



$loader = require_once '/var/www/app/vendor/autoload.php';
$n = new Customer();
$r = $loader->register();
var_dump($r);
echo "<pr>";
var_dump( __DIR__);