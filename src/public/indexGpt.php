<?php

require_once CLASS_LOADER_PATH;
require_once BASE_DIR . '/Lib/General/Core/AppLoader.php';

use General\Core\ClassLoader;
use General\Core\AppLoader;

// Initialize and register the ClassLoader
initializeClassLoader();

// Initialize and register the AppLoader
initializeAppLoader();

// Handle the controller request
handleControllerRequest();

/**
 * Initialize and register the ClassLoader
 */
function initializeClassLoader()
{
    $loader = new ClassLoader();
    $loader->addNamespace('General\Database', 'Lib/General/Database');
    $loader->addNamespace('General\Widgets', 'Lib/General/Widgets');
    $loader->addNamespace('General\Control', 'Lib/General/Control');
    $loader->addNamespace('General\Core', 'Lib/General/core');
    $loader->register();
}

/**
 * Initialize and register the AppLoader
 */
function initializeAppLoader()
{
    $appLoader = new AppLoader();
    $appLoader->register();
    $appLoader->addDirectory(WORKING_DIR . DIRECTORY_SEPARATOR . 'App');
}

/**
 * Handle the controller request
 */
function handleControllerRequest()
{
    if (isset($_GET['controller'])) {
        try {
            $pageControl = ucfirst(filter_input(INPUT_GET, 'controller', FILTER_SANITIZE_SPECIAL_CHARS));
            if (class_exists($pageControl)) {
                $controller = new $pageControl();
                $controller->show();
            } else {
                echo "The controller {$pageControl} does not exist.";
                die();
            }
        } catch (\Exception $e) {
            print $e->getMessage();
        }
    } else {
        echo "Controller was not informed in the URL.";
        die();
    }
}
