<?php

class Database
{
    // DataBase Configuration
    private $host = "localhost";
    private $username = "root";
    private $dbname = "sakila";
    private $password = "pass";
    private $connection;

    // DataBase Connection
    public function connect()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $err) {
            //throw $err;
            echo "Connection Error: " . $err->getMessage();
        }

        return $this->connection;
    }
}
