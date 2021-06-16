<?php

class BaseModel {
    protected $table;
    protected $db;

    function __construct() {
        $this->db = $this->getConnection();
    }
    public function getConnection() {
        /* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) 
Check whether the constant exist first using !defined(CONSTANT) before defining it. This
prevents the 'Constant already defined' error.
Reference: https://stackoverflow.com/questions/5887108/constant-already-defined-in-php/5887180
*/
        !defined('DB_SERVER') ? define('DB_SERVER', 'localhost') : '';
        !defined('DB_USERNAME') ? define('DB_USERNAME', 'root') : '';
        !defined('DB_PASSWORD') ? define('DB_PASSWORD', '') : '';
        !defined('DB_NAME') ?  define('DB_NAME', 'rll_registration_system') : '';

        $pdo = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    public function insert($table, $data) {
        $this->table = $table;
        $columns = $this->getColumns($data);
        $placeHolders = $this->getPlaceHoldersInsert($data);
        try {
            $sql = "INSERT INTO $this->table ($columns) VALUES ($placeHolders)";
            // Insert new record into the contacts table
            $stmt = $this->db->prepare($sql);

            $result['success'] = $stmt->execute(array_values($data));
            $result['message'] = $stmt->rowCount() == 1 ? "Record successfully created" : "";
            $result['id'] = $this->db->lastInsertId();
            return $result;
        } catch (PDOException $e) {
            $result['message'] = $e->getMessage();
            return $result;
        }
    }
    public function fetch($table, $id) {
        $this->table = $table;
        // Prepare a select statement
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        try {
            $stmt = $this->db->prepare($sql);
            $result['success'] = $stmt->execute([$id]);
            $result['rows'] = $stmt->fetch(PDO::FETCH_ASSOC);
            $result['message'] = count($result['rows']) >= 1 ? "Record successfully created" : "";
            return $result;
        } catch (PDOException $e) {
            $result['message'] = $e->getMessage();
            echo $e->getMessage();
        }
    }
    public function delete($table, $id) {
        $this->table = $table;
        // Prepare a delete statement
        $sql = "DELETE FROM $this->table WHERE id = ?";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            $result['success'] = $stmt->execute([$id]);
            $result['rows'] = $stmt->fetch(PDO::FETCH_ASSOC);
            $result['message'] = $stmt->rowCount() >= 1 ? "Record successfully created" : "";
            return $result;
        } catch (PDOException $e) {
            $result['message'] = $e->getMessage();
            echo $e->getMessage();
        }
    }
    public function update($table, $data) {
        $this->table = $table;
        $values = $this->getPlaceHoldersUpdate($data);
        //query
        $sql = "UPDATE $this->table SET $values WHERE id=?";

        try {
            $stmt = $this->db->prepare($sql);
            // Attempt to execute the prepared statement
            $result['success'] = $stmt->execute(array_values($data));
            $result['message'] = $stmt->rowCount() == 1 ? "Record successfully updated" : "";
            return $result;
        } catch (PDOException $e) {
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    public function fetchAll($table) {
        $this->table = $table;
        $sql = "SELECT * FROM $this->table";
        try {
            // Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
            $stmt = $this->db->prepare($sql);
            $result['success'] = $stmt->execute();
            // Fetch the records so we can display them in our template.
            $result['rows'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result['message'] = count($result['rows']) >= 1 ? "Record successfully created" : "";
            return $result;
        } catch (PDOException $e) {
            $result['message'] = $e->getMessage();
            echo $e->getMessage();
            return $result;
        }
    }

    /*
    Helper functions, they are used by the insert, fetch, delete, update, and fetchAll methods.
    */
    private function getColumns($data) {
        return implode(", ", array_keys($data));
    }
    private function getPlaceHoldersInsert($data) {
        return  str_repeat('?,', count($data) - 1) . '?';
    }
    private function getPlaceHoldersUpdate($data) {
        //delete it from the array
        array_pop($data);
        //create values placeholders for the update SQL query
        $values = implode("=?, ", array_keys($data)) . "=?";
        return $values;
    }
}

$model = new BaseModel();
