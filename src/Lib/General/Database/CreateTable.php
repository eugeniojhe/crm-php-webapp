<?php

namespace General\Database;

use General\Log\Logger;
use General\Log\LoggerTXT;
use General\Log\LoggerXML;
use General\Log\LoggerJSON;
use General\Log\Config;

abstract class CreateTable
{

        private static $pdo = null;
        private $table;
        private $fields;

        private $conn;

        private $obj;

        public function __construct()
        {
            $this->obj = get_class($this);
            $this->table = $this->getEntity();
            $this->fields = $this->getFields();
            $this->conn = Connection::open();
            Transaction::setLogger(new LoggerJSON(Config::getLogFileJSON()));
        }

        private function getEntity()
        {
            return constant("{$this->obj}::TABLE");
        }

        private function getFields()
        {
            return constant("{$this->obj}::FIELDS");
        }

        public   function run()
        {
            //If you want to, uncomment
//            echo "=====================\n";
//            echo "Creating table {$this->table}";
//            echo "\n";

            try {
                if (empty($this->table) OR empty($this->fields)) {
                   throw new \Exception('Table or Fields not provided in ' . __CLASS__);
                }

                $this->table =   strtolower($this->sanitizeTableName());
                $this->fields  = $this->sanitizeFields($this->table);
                if (empty($this->fields) or empty($this->table)) {
                    throw new \Exception('Invalid name Table or Fields not provided in ' . __CLASS__);
                }

                $sql = "SHOW TABLES LIKE '" . $this->table . "'";
                $result =  $this->conn->query($sql);
                if ($result && $result->rowCount() > 0) {
                    throw new \Exception("Table '" . $this->table . "' already exists.\n");
                }

                $sql = "CREATE TABLE IF NOT EXISTS " . $this->table . " ( ";
                $sql.= implode(", ", $this->fields);
                $sql.= ")";
                Transaction::log($sql);
                $this->conn->query($sql);

            } catch (\Exception $e) {

              //  echo $e->getMessage(); //If you want, uncomment,
                Transaction::log($e->getMessage());
             //   echo "=====================\n"; //If you want uncomment
                return false;
            }
            echo "Table=> {$this->table} created successfully.\n";
            echo "=====================\n";
            return true;

        }

    private function sanitizeTableName()
        {
            return preg_replace('/[^a-zA-Z0-9_]/', '', $this->table);
        }

        private function sanitizeFields(): array
        {
            $sanitizedFields = [];

            foreach ($this->fields as $field) {
                $sanitizedField = preg_replace('/[^a-zA-Z0-9_(),\s]/', '', $field);
                if (!empty($sanitizedField)) {
                    $sanitizedFields[] = $sanitizedField;
                }
            }

            return $sanitizedFields;
        }
}