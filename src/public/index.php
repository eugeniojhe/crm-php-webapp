<?php
require_once './indexFunctions.php';
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';

use General\Database\Transaction;

initializeClassLoader();

initializeAppLoader();

handleRequest();


Transaction::open();

Transaction::close();