<?php
class Database{
    private $host="localhost";
    private $user="root";
    private $password="";
    private $dbname="crud-pdo";
    private $conn;

    public function __construct(){
        $this->conn= new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "database connected successfully<br>";

    }
    public function getConnection(){
        return $this->conn;
    }
}



?>