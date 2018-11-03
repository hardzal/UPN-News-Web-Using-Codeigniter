<?php
class CRUD {
    private $_conn;
    private $_query;
    private $_queryRun;
    private $_rows = array();

    public function __construct($dbHost, $dbUser, $dbPassword, $dbName)
    {
        $this->_conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
        if(!$this->_conn) die("Error: ". mysqli_error($this->_conn));
    }

    public function connect() 
    {
        return $this->_conn;
    }

    public function disconnect() {
        // mysqli_stmt_close($this->connect());
        return mysqli_close($this->connect());
    }

    public function setQuery($query) {
        $this->_query = $query;
    }

    public function getQuery() {
        return $this->_query;
    }

    public function querySimple() {   
        $this->_queryRun = mysqli_query($this->connect(), $this->getQuery());
    }
    
    public function queryRun() {
        return $this->_queryRun;
    }

    public function queryShow() {
        $this->_rows = mysqli_fetch_array($this->queryRun());
        return $this->_rows;
    }

    public function selectSpesify($table, $column, $values) {
        $stmt = mysqli_prepare($this->connect(), "SELECT * FROM {$table} WHERE {$column} = '{$values}'");
        mysqli_stmt_bind_param($stmt, "s", $values);
        mysqli_stmt_execute($stmt);
        if(!$stmt) die(mysqli_errno($this->connect())."::".mysqli_error($this->connect()));
        else {
            $this->_queryRun = mysqli_stmt_get_result($stmt);
        }
    }

    public function createSpesify($table, $column, $value) {
        $query = mysqli_query($this->connect(), "INSERT INTO {$table} VALUES {$column} = '{$value}'");
        
    }

    public function updateSpesify($table, $column, $values, $key, $value) {
        $query = mysqli_query($this->connect(), "UPDATE {$table} SET {$column} = '{$values}' WHERE {$key} = '{$value}'");
        
    }

    public function deleteSpesify($table, $column, $value) {
        $query = mysqli_query($this->connect(), "DELETE FROM {$table} WHERE {$column} = '{$value}'");
        if(!$query) die(mysqli_errno($this->connect())."->".mysqli_error($this->connect()));
        else {
            return "<script>alert('Berhasil menghapus data!')</script>";
        }
    }
}
?>