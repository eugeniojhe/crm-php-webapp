<?php
// http://host.docker.internal/rest.php?class=PessoaService&method=GetData&id=1

//$location = "http://localhost/rest.php";
//$location = "http://host.docker.internal/rest.php";
$location = "http://web/rest.php";
$parameters['class'] = "PessoaService";
$parameters['method'] = "getData";
$parameters['id'] = 3;

echo "<div class='panel panel-default' style='margin: 40px'>\n";

echo "</div>";

$url = $location . "?" . http_build_query($parameters);
// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    die("Error: Unable to fetch data from the URL. cURL error: " . $error);
}

// Close cURL session
curl_close($ch);

// Decode the JSON response
$responseData = json_decode($response, true); // true for associative array
var_dump($responseData);

