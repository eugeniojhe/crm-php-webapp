<?php

use Servers\RestServer;

header('Content-Type: application/json; charset=utf-8');
require_once "/var/www/Lib/General/Core/AppLoader.php";


$classLoader = getenv('CLASS_LOADER_PATH');


require_once($classLoader);

$loader = new General\Core\ClassLoader();
$loader->addNamespace('General\Database', 'Lib/General/Database');
$loader->register();

$appLoader = new General\Core\AppLoader();

$appLoader->register();
$appLoader->addDirectory('/var/www/App');


print RestServer::run($_REQUEST);



