<?php

class Database {
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct() {
        require_once('../config/db.php');
        $this->host = Config::$host;
        $this->username = Config::$user;
        $this->password = Config::$password;
        $this->database = Config::$database;

        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        $this->connection->set_charset("utf8");

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }


    public function __destruct() {
        $this->connection->close();
    }
}


?>