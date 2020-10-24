<?php

namespace local\core;
use PDO;
class Database {
    private $results;
    private $errors = false;
    private $PDO_PARAMS = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
    private $PDO;
    private static $instance = null;

    private function __construct() {
        try {
            $this->PDO = new PDO('mysql:host=localhost;dbname=tryshop', 'root', '');
        } catch(\PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Database;
        }

        return self::$instance;
    }

    private static function catchPDOerrors($query):bool {
        $errors = $query->errorInfo();
        if ($errors[0] !== PDO::ERR_NONE) {
            die($errors[2]);
        }

        return true;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getResults() {
        return $this->results;
    }

    public function getResult() {
    }

    public function query($sql, $params = []) {
        $this->stmt = $this->PDO->prepare($sql);
        if (count($params)) {
            $i = 1;
            foreach($params as $param) {
                $this->stmt->bindValue($i, $param);
                $i++;
            }
        }
        $this->stmt->execute();
        self::catchPDOErrors($this->stmt);
        $this->results = $this->stmt->fetchAll(PDO::FETCH_OBJ);
        return $this;
    }

    public function queryActionOperator(string $tableName, array $filter, $action) {
        $sql = "{$action} FROM " . $tableName;
        if (count($filter) === 3) {
            $key = $filter[0];
            $operand = $filter[1];
            $value = $filter[2];

            $allowOperands = ['<', '>', '=', '<=', '>='];
            if (in_array($operand, $allowOperands)) {
                $sql = $sql . " WHERE " . $key . ' ' .  $operand . ' ?';
                $this->query($sql, [$value]);
            }
        } else {
            $this->query($sql);
        }
        return $this;
    }

    public function select(string $tableName, array $filter = [], string $selectRule = 'SELECT *') {
        return $this->queryActionOperator($tableName, $filter, $selectRule);
    }

    public function delete(string $tableName, array $filter, string $selectRule = 'DELETE') {
        return $this->queryActionOperator($tableName, $filter, $selectRule);
    }

    public function update($tableName, $requestId, $matchId, array $changeFields):bool {
        $maskString = '';
        if (count($changeFields)) {
            foreach ($changeFields as $key => $changeField) {
                $maskString .= '{$key} = ?,';
            }
            $maskString = rtrim($maskString, ',');
            $sql = "UPDATE {$tableName} SET {$maskString} WHERE {$requestId} = {$matchId}";
            $this->query($sql, $changeFields);
            return true;

        } else {
            return false;
        }
    }

    public function insert(string $tableName, array $fields) {
        if (empty($tableName) || !count($fields)) return false;

        $maskString = '';
        foreach ($fields as $field) {
            $maskString .= '?,';
        }
        $maskString = rtrim($maskString, ',');
        $sql = "INSERT INTO {$tableName} " . "(`" . implode('`, `',array_keys($fields)) . "`)" . " VALUES " . "(" . $maskString . ")";
        $this->query($sql, $fields);

        return true;
    }
}