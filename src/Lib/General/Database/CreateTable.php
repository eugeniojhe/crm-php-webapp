<?php

namespace General\Database;

abstract class CreateTable
{

        private $pdo = null;
        private $table;

        public function __construct($tableAndFields)
        {
            $this->pdo = Transaction::open();
            $this->table = $tableAndFields;
        }


        private function getEntity()
        {
            $class = get_called_class();
            return constant("{$class}::TABLE");
        }

        public function run()
        {

            echo "=====================";
            echo "\n";

            try {


                if (empty($this->table['fields']) OR empty($this->table['tableName'])) {
                   throw new \Exception('Table or Fields not provided in ' . __CLASS__);
                }

                $tableName =   strtolower($this->sanitizeTableName($this->table['tableName']));
                $fields = $this->sanitizeFields($this->table['fields']);
                if (empty($fields) or empty($tableName)) {
                    throw new \Exception('Invalid name Table or Fields not provided in ' . __CLASS__);
                }

                $sql = "SHOW TABLES LIKE '" . $tableName . "'";
                $conn = Transaction::get();
                $result =  $conn->query($sql);
                if ($result && $result->rowCount() > 0) {
                    throw new \Exception("Table '" . $tableName . "' already exists.\n");
                }

                $sql = "CREATE TABLE IF NOT EXISTS " . $tableName . " ( ";
                $sql.= implode(", ", $fields);
                $sql.= ")";
                $connection = Transaction::get();
                $connection->exec($sql);
                Transaction::close();

            } catch (\Exception $e) {
                echo $e->getMessage();
//                Transaction::rollback();
//                $this->closeConnection();
            }

            echo "=====================";
            echo "\n";

        }

    private function sanitizeTableName($tableName)
        {
            return preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);
        }

        private function sanitizeFields($fields): array
        {
            $sanitizedFields = [];

            foreach ($fields as $field) {
                $sanitizedField = preg_replace('/[^a-zA-Z0-9_(),\s]/', '', $field);
                if (!empty($sanitizedField)) {
                    $sanitizedFields[] = $sanitizedField;
                }
            }

            return $sanitizedFields;
        }
        public function closeConnection()
        {
            Transaction::close();
        }


}