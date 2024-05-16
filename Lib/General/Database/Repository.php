<?php

namespace General\Database;
use Model\Produto;
//
//use Couchbase\TermRangeSearchQuery;
//use PHPMailer\PHPMailer\Exception;

class Repository
{

    private $activeRecord;
    public function __construct($class)
    {
        $this->activeRecord = get_class($class);

    }
    public function load(Criteria $criteria)
    {
        $sql = "SELECT * FROM ".$this->activeRecord::TABLENAME;
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
     //  var_dump($result);
        if ($result) {
            while ($row = $result->fetchObject( $this->activeRecord )) {
                $results[] = $row;
            }
        }
        return $results;
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