<?php

namespace General\Database;

class Repository
{
    private $activeRecord;
    public function __construct($class)
    {
        $this->activeRecord = $class;

    }
    public function load(Criteria $criteria)
    {
        $sql = "SELECT * FROM " . constant($this->activeRecord.'::TABLENAME');

        Transaction::log($sql);
        $results = [];

        if ($criteria) {
            $expression = $criteria->dump();
            if ($expression) {
                $sql .= " WHERE ".$expression;
            }
            $order = $criteria->getProperty('order');
            $limit = $criteria->getProperty('limit');
            $offset = $criteria->getProperty('offset');

            if ($order) {
                $sql .= ' ORDER BY '.$order;
            }
            if($limit) {
                $sql .= ' LIMIT '.$limit;
            }
            if ($offset) {
                $sql .= ' OFFSET '.$offset;
            }

        }
        $conn = Transaction::get();
        if(!$conn) {
            throw new Exception('Não existe conexão com o BD');
        }
        Transaction::log($sql);
        $result = $conn->query($sql);

        if ($result) {
            while ($row = $result->fetchObject( $this->activeRecord )) {
                $results[] = $row;
            }
        }
        return $results;
    }

    public static function __callStatic(string $name, array $arguments)
    {
        // TODO: Implement __callStatic() method.
    }

    public function delete(Criteria $criteria)
    {

        $sql = "DELETE FROM " . constant($this->activeRecord . '::TABLENAME');


        if ($criteria) {
            $expression = $criteria->dump();
            if ($expression) {
                $sql .= " WHERE ".$expression;
            }
            $conn = Transaction::get();
            if (!$conn) {
                throw new  Exception('Não existe conexão com o BD');
            }

            return $conn->exec($sql);
        }

        return '';

    }

    public function count($criteria = null)
    {
        $row[0] = 0;
        $sql = "SELECT COUNT(*) FROM ".constant($this->activeRecord.'::TABLENAME');
        if ($criteria) {
            $expression = $criteria->dump();
            if ($expression) {
                $sql .= " WHERE ".$expression;
            }
        }

        $conn = Transaction::get();

        if (!$conn) {
            throw new Exception('Não exite conexão ativa');
        }

        Transaction::log($sql);
        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch();
            return $row[0];
        }
        return $row[0];
    }
}