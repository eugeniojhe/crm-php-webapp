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


use Database\DDL\TableEstado;
use Database\DDL\TableCidade;
use Database\DDL\TableGrupo;
use Database\DDL\TableFabricante;
use Database\DDL\TableUnidade;
use Database\DDL\TableTipo;
use Database\DDL\TableProduto;
use Database\DDL\TablePessoa;
use Database\DDL\TableVenda;
use Database\DDL\TableItemVenda;
use Database\DDL\TableConta;
use Database\DDL\TablePessoaGrupo;
use Database\DDL\TableFuncionario;


require_once "/var/www/App/Database/DDL/TableFuncionario.php";

$table = new TableEstado();
$table->run();

$table = new TableCidade();
$table->run();


$table = new TableGrupo();
$table->run();


$table = new TableFabricante();
$table->run();


$table = new TableUnidade();
$table->run();


$table = new TableTipo();
$table->run();



$table = new TableProduto();
$table->run();

$table = new TablePessoa();
$table->run();


$table = new TableVenda();
$table->run();


$table = new TableConta();
$table->run();


$table = new TableItemVenda();
$table->run();


$table = new TableConta();
$table->run();


$table = new TablePessoaGrupo();
$table->run();


$funcionario = new TableFuncionario();
$funcionario->run();

echo "End of script\n";




