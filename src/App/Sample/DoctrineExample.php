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

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

$t->register();


$dotenv = Dotenv\Dotenv::createImmutable(WORKING_DIR);
$dotenv->load();

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$db = getenv('DB_NAME');

$connectionParams = [
    'dbname' => $db,
    'user' => $user,
    'password' => $password,
    'host' => $host,
    'port' => 3306,
    'driver' => 'pdo_mysql',
];


try {
    $connection = DriverManager::getConnection($connectionParams);

    // Read the SQL script from a file
    $sqlScript = file_get_contents('/var/www/App/Scripts/tableCidades.sql');

    // Execute the SQL script
    $connection->executeStatement($sqlScript);

    echo "SQL script executed successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    die();
} finally {
    // Close the connection
//    $connection->close();
}


