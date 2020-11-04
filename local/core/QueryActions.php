<?php

namespace Core\QueryActions;

class QueryActions {
    protected $db;
    protected $errors;

    public function __construct($db) {
        
    }

    public function getQuery($sql, $params = []):PDOStatement {
        if (!$sql) return false;

        $query = $this->db->prepare($sql);
        $query->execute($params);
        $this->checkQueryErrors($query);

        return $query;
    }

    public function checkQueryErrors($query):bool {
        $errors = $query->errorInfo();

        if ($errors[0] !== PDO::ERR_NONE) {
        }
        return true;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function setDb($db) {
        $this->db = $db;
    }

    public function getDb() {
        return $this->db;
    }
}