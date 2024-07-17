<?php

echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';

use General\Database\Transaction;
require_once "/var/www/Lib/General/Core/AppLoader.php";
$t = require_once '/var/www/vendor/autoload.php';
$t->register();

$classLoader = getenv('CLASS_LOADER_PATH');


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

use Services\PessoaService;
use Control\PessoaControl;


Transaction::open();


Transaction::close();


//echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
//echo '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">';

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
