<?php


DEFINE('WORKING_DIR', getenv('WORKING_DIR'));
DEFINE('CLASS_LOADER', getenv('CLASS_LOADER'));
DEFINE('APP_LOADER', getenv('APP_LOADER'));
DEFINE('AUTO_LOADER', getenv('AUTO_LOADER'));

require_once CLASS_LOADER; //General loaders - Core project - This can be used for other projects that use the same structure
require_once APP_LOADER; //Looders  of app
$t = require_once AUTO_LOADER; //AutoLoader for Doteven

use General\Core\ClassLoader;
use General\Core\AppLoader;


$t->register();


$dotenv = Dotenv\Dotenv::createImmutable(WORKING_DIR);
$dotenv->load();
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

    } else {
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
    $loader->addNamespace('General\Cache', 'Lib/General/Cache');
    $loader->register();
}

function initializeAppLoader()
{
    $appLoader = new AppLoader();
    $appLoader->register();
    $appLoader->addDirectory(WORKING_DIR . DIRECTORY_SEPARATOR . 'App');
}
