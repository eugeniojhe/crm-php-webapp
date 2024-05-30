<?php
// http://host.docker.internal/rest.php?class=PessoaService&method=GetData&id=1

$location = "http://localhost/rest.php";
//$location = "http://host.docker.internal/rest.php";
$parameters['class'] = "PessoaService";
$parameters['method'] = "getData";
$parameters['id'] = 1;

$url = $location . "?" . http_build_query($parameters);
var_dump($url); // Debug line to check the URL



$response = file_get_contents($url);
if ($response === FALSE) {
    die("Error: Unable to fetch data from the URL.");
}

$responseData = json_decode($response, true); // Decode JSON response to array
var_dump($responseData);

