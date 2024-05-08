<?php
namespace APP\Eugenio;

require_once 'Record.php';
require_once 'JSONExporter.php';
require_once 'ExporterInterface.php';
Require_once 'ObjectConversionTrait.php';
Use  APP\Record\Record;
class Car extends Record
{

    const TABLE = "Car";
    use ObjectConversionTrait;

    public function exporter(ExporterInterface $exporter)
    {
       return $exporter->exporter($this->data);
    }
}

$c = new Car;
$c->nome ="Fiat Uno 1000";
$c->fabricante = "Fiat Automoveis";
$c->ano = "2014";
$c1 = $c->exporter(new JSONExporter);
print_r($c1);
echo "<br>";
print_r($c->toXml());


