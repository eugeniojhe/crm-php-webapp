<?php

DEFINE('WORKING_DIR', getenv('WORKING_DIR'));
DEFINE('CLASS_LOADER', getenv('CLASS_LOADER'));
DEFINE('APP_LOADER', getenv('APP_LOADER'));
DEFINE('AUTO_LOADER', getenv('AUTO_LOADER'));


require_once CLASS_LOADER; //General loaders - Core project - This can be used for other projects that use the same structure
require_once APP_LOADER; //Looders  of app
$composerAutoLoader = require_once AUTO_LOADER; //AutoLoader for Doteven

use General\Core\ClassLoader;
use General\Core\AppLoader;

$composerAutoLoader->register();

$dotenv = Dotenv\Dotenv::createImmutable(WORKING_DIR);
$dotenv->load();

function handleRequest():void
{
    $file = $_ENV['MAIN_TEMPLATE'];
    $template = file_get_contents($file);
    $content = '';
    $pageControl = 'Home';
    if (isset($_GET['controller'])) {

        try {
            $pageControl = ucfirst(filter_input(INPUT_GET,
                'controller',
                FILTER_SANITIZE_SPECIAL_CHARS));
            if (class_exists($pageControl)) {
                ob_start();
                $page = new $pageControl();
                $page->show();
                $content = ob_get_clean();


            } else {
                $content =  "O Controller <b>{$pageControl}</b> do not exist ";
            }

        } catch (\Exception $e) {
            $content =  $e->getMessage();
        }

    } else {
        $content =  "Controller <b>{$pageControl}</b> do not exist ";
    }
   $output = str_replace('{content}', $content, $template);
   $output = str_replace('{class}',   $pageControl, $output);
   echo $output;
}

function initializeClassLoader():void
{
    $loader = new ClassLoader();
    $loader->addNamespace('General\Database', 'Lib/General/Database');
    $loader->addNamespace('General\Widgets', 'Lib/General/Widgets');
    $loader->addNamespace('General\Control', 'Lib/General/Control');
    $loader->addNamespace('General\Core', 'Lib/General/core');
    $loader->addNamespace('General\Cache', 'Lib/General/Cache');
    $loader->addNamespace('General\Traits', 'Lib/General/Traits');
    $loader->register();
}

function initializeAppLoader():void
{
    $appLoader = new AppLoader();
    $appLoader->register();
    $appLoader->addDirectory(WORKING_DIR . DIRECTORY_SEPARATOR . 'App');
}
