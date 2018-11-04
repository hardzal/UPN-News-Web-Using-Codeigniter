<?php
session_start();
class CRUD {
    private $_conn;
    private $_query;
    private $_queryRun;
    private $_queryPrepare;
    private $_rows = array();

    public function __construct($dbHost, $dbUser, $dbPassword, $dbName) {
        $this->_conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
        if(!$this->_conn) die("Error: ". mysqli_error($this->_conn));
    }

    public function connect() {
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
        if(!$this->_queryRun) $this->errorOutput();
    }
    
    public function queryRun() {
        return $this->_queryRun;
    }

    public function getRows() {
        return mysqli_num_rows($this->queryRun());
    }

    public function queryShow() {
        $this->_rows = mysqli_fetch_array($this->queryRun());
        return $this->_rows;
    }

    public function selectSpesify($query) {
        $this->_queryPrepare = mysqli_prepare($this->connect(), $query);
    }

    public function bindSelect() {
        list($type, $username, $password) = func_get_args();
        mysqli_stmt_bind_param($this->_queryPrepare, $type, $username, $password);
        mysqli_stmt_execute($this->_queryPrepare);
        if(!$this->_queryPrepare) $this->errorOutput(); 
        else {
            $this->_queryRun = mysqli_stmt_get_result($this->_queryPrepare);
        }
    }

    public function createSpesify($table, $column, $value) {
        $this->_queryRun = mysqli_query($this->connect(), "INSERT INTO {$table} VALUES {$column} = '{$value}'");
        if(!$this->_queryRun) $this->errorOutput();
    }
    
    public function updateSpesify($table, $data, $key, $value) {
        $this->_queryRun = mysqli_query($this->connect(), "UPDATE {$table} SET {$data} WHERE {$key} = '{$value}'");
        if($this->_queryRun) $this->errorOutput();
    }

    public function deleteSpesify($table, $column, $value) {
        $_queryRun = mysqli_query($this->connect(), "DELETE FROM {$table} WHERE {$column} = '{$value}'");
        if(!$_queryRun) die(mysqli_errno($this->connect())."->".mysqli_error($this->connect()));
        else {
            return "<script>alert('Berhasil menghapus data!')</script>";
        }
    }


    public function addPost() {
        list($username, $headline, $judul, $kategori, list($file_name, $file_size, $file_type, $file_tmp), $isi) = func_get_args();
        $headline = trim($headline);
        $judul = trim($judul);
        $isi = trim($isi);
        $file_destination = "img/";
        $hari = date('l', time());
        if(move_uploaded_file($file_tmp, $file_destination.$file_name)) {
            $query = "INSERT INTO berita VALUES('', '1', '$username', '$judul', '$headline', '$isi', '$hari', now(), now(), '$file_name')";
            $this->setQuery($query);
            $this->querySimple();
            if($this->queryRun()) {
                echo "<script>alert('berhasil menambahkan berita!')</script>";
            } 
        } else {
            echo "<script>alert('Gagal menambahkan berita baru!')</script>";
        }
    }

    public function updatePost() {

    }

    public function delPost($id) {
        $this->deleteSpesify("berita", "no_berita", $id);
        header("Location: user.php?post=index");
    }

    public function sessionSave($username) {
        if(mysqli_num_rows($this->queryRun()) == 1) {
            $_SESSION['username'] = $username;
            header("Location:user.php?post=index");
        } else {
            echo "<script>alert('Username/Password salah')</script>";
        }
    }

    public function sessionGet() {
        return $_SESSION['username'];
    }

    public function checkLogin() {
        if(!isset($_SESSION['username'])&&empty($_SESSION['username'])) {
            return false;
        } else {
            return true;
        }
    }

    public function logout() {
        unset($_SESSION['username']);
    }

    public function errorOutput() {
        die(mysqli_errno($this->connect())."::".mysqli_error($this->connect()));
    }
}

$crud = new CRUD("localhost", "root", "", "berita_upn");
?>