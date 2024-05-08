<?php
   require_once "../app/DM/Products.php";
   require_once "/var/www/app/modulo5/classes/api/Connection.php";

     try {
         Connection::open();
     } catch (Exception $e) {
         print $e->getMessage();
     }

     echo "<h1>Conectado com sucesso</h1>" ;


