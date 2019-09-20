<?php
require_once('shortModel.php');
class connectionModel extends shortModel
{
    private $server;
    private $database;
    private $username;
    private $password;
    protected $connection;

    public function __construct()
    {
        $this->server = "localhost";
        $this->database = "shorturl";
        $this->username = "root";
        $this->password = "";
        try {
            $pdo = new PDO("mysql:host=$this->server;dbname=$this->database", $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection = $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->connection = NULL;
    }
}