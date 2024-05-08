<?php
require_once 'ExporterInterface.php';

class JSONExporter implements ExporterInterface
{
    public function exporter($data)
    {
        return json_encode($data);
    }
}