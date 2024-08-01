<?php
var_dump(phpinfo());
die();
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';

DEFINE('WORKING_DIR', getenv('WORKING_DIR'));
DEFINE('CLASS_LOADER', getenv('CLASS_LOADER'));
DEFINE('APP_LOADER', getenv('APP_LOADER'));
DEFINE('AUTO_LOADER',getenv('AUTO_LOADER'));

require_once CLASS_LOADER;
require_once APP_LOADER ;

use General\Core\ClassLoader;
use General\Core\AppLoader;
use General\Database\Transaction;

$t = require_once AUTO_LOADER;
$t->register();


$dotenv = Dotenv\Dotenv::createImmutable(WORKING_DIR);
$dotenv->load();

initializeClassLoader();

initializeAppLoader();

handleRequest();

Transaction::open();

Transaction::close();




function handleRequest()
{
    if (isset($_GET['controller'])) {

        try {
            $pageControl = ucfirst(filter_input(INPUT_GET,
                'controller',
                FILTER_SANITIZE_SPECIAL_CHARS));
            if (class_exists($pageControl)) {
                $pageControl = new $pageControl;
                $pageControl->show();

            } else {
                echo "O Controller {$pageControl} do not exist ";
                die();
            }

        } catch (\Exception $e) {
            print $e->getMessage();
        }

    }  else {
        echo "Controle  was not informed on Url ";
        die();
    }

}

function initializeClassLoader()
{
    $loader = new ClassLoader();
    $loader->addNamespace('General\Database', 'Lib/General/Database');
    $loader->addNamespace('General\Widgets', 'Lib/General/Widgets');
    $loader->addNamespace('General\Control', 'Lib/General/Control');
    $loader->addNamespace('General\Core', 'Lib/General/core');
    $loader->register();
}

 function initializeAppLoader()
{
    $appLoader = new AppLoader();
    $appLoader->register();
    $appLoader->addDirectory(WORKING_DIR.DIRECTORY_SEPARATOR.'App');
}

