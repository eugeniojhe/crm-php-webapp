<?php

class ConnectionOld
{

    private function __construct(){}
    public static function open($name)
    {

        if (file_exists("/var/www/app/Config/{$name}.ini")) {
            $bd = parse_ini_file("/var/www/app/Config/{$name}.ini");
        } else {
            throw new Exception("Arquivo {$name} não existe... ");
        }

        $host = isset($bd['host']) ? $bd['host'] : null;
        $user = isset($bd['user']) ? $bd['user'] : null;
        $password = isset($bd['password']) ? $bd['password'] : null;
        $db = isset($bd['db']) ? $bd['db'] : null;
        $type = isset($bd['type']) ? $bd['type'] : null;
        var_dump($bd);

        switch ($type) {
            case "mysql" :
                $conn = new PDO("mysql:host=$host;dbname=$db", $user,
                    $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);
                echo '<h2>Conectado com sucesso.<h2>';
                break;
            case "pgsql" :
                $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
                // make a database connection
                $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                if ($pdo) {
                    echo "Connected to the $db database successfully!";
                }
                break;
            case "sqllite" :
                break;
        }

        $conn->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
        return $conn;


    }
}