<?php

       require_once "/var/www/Lib/General/Database/Connection.php";
       require_once "/var/www/Lib/General/Core/ClassLoader.php";


       use General\Database\Connection;

class ClassLoader
{
    public  $prefixes = array();

    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function addNamespace($prefix, $base_dir, $prepend = false)
    {
        // normalize namespace prefix
        $prefix = trim($prefix, '\\') . '\\';

        // normalize the base directory with a trailing separator
        $base_dir = rtrim($base_dir, DIRECTORY_SEPARATOR) . '/';

        // initialize the namespace prefix array
        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = array();
        }

        // retain the base directory for the namespace prefix
        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $base_dir);
        } else {
            array_push($this->prefixes[$prefix], $base_dir);
        }
    }

    public function loadClass($class)
    {
        // the current namespace prefix
        $prefix = $class;

        // work backwards through the namespace names of the fully-qualified
        // class name to find a mapped file name
        while (false !== $pos = strrpos($prefix, '\\')) {

            // retain the trailing namespace separator in the prefix
//            var_dump($pos);
//            echo "<br>";
//            echo "====<br>";
            $prefix = substr($class, 0, $pos + 1);

            // the rest is the relative class name
            $relative_class = substr($class, $pos + 1);

            var_dump($prefix, $relative_class);
            echo "<br>";

            // try to load a mapped file for the prefix and relative class
            $mapped_file = $this->loadMappedFile($prefix, $relative_class);
            if ($mapped_file) {
                return $mapped_file;
            }

            // remove the trailing namespace separator for the next iteration
            // of strrpos()
            $prefix = rtrim($prefix, '\\');
        }

        // never found a mapped file
        return false;
    }

    protected function loadMappedFile($prefix, $relative_class)
    {
        // are there any base directories for this namespace prefix?
        if (isset($this->prefixes[$prefix]) === false) {
            return false;
        }

        // look through base directories for this namespace prefix
        foreach ($this->prefixes[$prefix] as $base_dir) {

            // replace the namespace prefix with the base directory,
            // replace namespace separators with directory separators
            // in the relative class name, append with .php
            $file = '/var/www/'.$base_dir
                . str_replace('\\', '/', $relative_class)
                . '.php';

            // if the mapped file exists, require it
            print $file;
            if ($this->requireFile($file)) {
                // yes, we're done
                echo "<br><br>";
                var_dump($file);
                echo "<br><br>";
              //  return TRUE;
               return $file;
            }
        }

        // never found it
        return false;
    }

    protected function requireFile($file)
    {
        if (file_exists($file)) {
            echo "<br>";
            var_dump($file);
            echo "<br>";
           // require $file;
             require_once("{$file}");
            return true;
        }
        return false;
    }
}


$string = "AJAJJ";

//$p = strrpos($string, 'A');
//$substr = substr($string, $p);
//echo $substr."<br>";
//echo $p."<br>";



//$loader = new ClassLoader();
$loader = new General\Core\ClassLoader();
$loader->addNamespace('General\Database', 'Lib/General/Database');
$loader->register();


$t = new General\Database\Criteria();
echo "O Objeto <br><br>";
var_dump($t);


die();





$conn = Connection::Open();
       var_dump($conn);
       Echo "That is ok";


        $iniLoadedFile = php_ini_loaded_file();
       echo $iniLoadedFile.PHP_EOL;
       die(); 


        $host = "db";
        $username = "root";
        $password = "root";
        $db = "php_treina";
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db", $username,
                $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
            echo '<h2>Conectado com sucesso.<h2>';
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }


        require_once '../app/ActiveRecord/Produto.php';
        Produto::setConnection($conn);




        $produtos = Produto::all();
        foreach ($produtos as $produto) {
            echo $produto->id."<br>";
            $produto->delete();
        }


        $produto = new Produto;



        $produto->descricao = "Vinho tinto tres ranchos";
        $produto->preco_venda = "1500.00";
        $produto->preco_custo = "900.00";
        $produto->estoque = 10;
        $produto->codigo_barras = "ABCD";
        $produto->data_cadastro = date("Y-m-d H:i:s");
        $produto->origem = "Brasil";

        $produto->save();


        $produto->id = 1;
        $produto->find(1);

        $produto->preco_custo = "1000000.00";
        $produto->estoque = 500;
        $produto->save();

        $m = $produto->getMargemLucro();
        echo $m."<br>";





        die('ok');

        $p = Produto::find(1);



        echo $m;
        echo "<br>";

        die('Dying');




        die('0000');
