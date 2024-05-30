<?php

        require_once "/var/www/Lib/General/Core/AppLoader.php";

        $classLoader = getenv('CLASS_LOADER_PATH');


        require_once($classLoader);

        $loader = new General\Core\ClassLoader();
        $loader->addNamespace('General\Database', 'Lib/General/Database');
        $loader->register();

        $appLoader = new General\Core\AppLoader();
        $appLoader->register();
        $appLoader->addDirectory('/var/www/App');

        use Services\PessoaService;
        use Control\PessoaControl;


        if (isset($_GET['controller']) && isset($_GET['method'])) {

            try {
                    $pageControl = "Control\\".ucfirst(filter_input(INPUT_GET,
                                                                    'controller',
                                                                    FILTER_SANITIZE_SPECIAL_CHARS));
                    if (class_exists($pageControl)) {
                        $pageControl = new $pageControl;
                        $pageControl->show();

                    } else {
                        echo "O Controller {$pageControl} não existe ";
                        die();
                    }

            } catch (\Exception $e) {
                 print $e->getMessage();
            }

        }  else {
            echo "Controle não informado na URL";
            die();
        }

        die();