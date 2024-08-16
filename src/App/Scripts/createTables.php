<?php
require_once "/var/www/Lib/General/Core/AppLoader.php";
$t = require_once '/var/www/vendor/autoload.php';
$t->register();
$classLoader = getenv('CLASS_LOADER');
$dotenv = Dotenv\Dotenv::createImmutable(realpath(__DIR__ . '/../../'));
$dotenv->load();


require_once($classLoader);

$loader = new General\Core\ClassLoader();
$loader->addNamespace('General\Database', 'Lib/General/Database');
$loader->addNamespace('General\Widgets', 'Lib/General/Widgets');
$loader->addNamespace('General\Control', 'Lib/General/Control');
$loader->addNamespace('General\Log', 'Lib/General/Log');
$loader->register();

$appLoader = new General\Core\AppLoader();
$appLoader->register();
$appLoader->addDirectory('/var/www/App');


use Database\CreateTableFuncionario;

require_once "/var/www/App/Database/CreateTableFuncionario.php";

echo "Creating functionario tabela\n";
$funcionario = new CreateTableFuncionario();
$funcionario->run();
echo "End of script\n";




