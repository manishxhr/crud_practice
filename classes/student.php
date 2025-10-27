<?php
class Student{
    private $conn;
    private $table='users';

    public function __construct($db)
    {
        $this->conn=$db;
    }

    public function create($name,$email,$password){
        $sql="insert into $this->table (name, email, password) VALUES (:name, :email, :password)";
        $stmt= $this->conn->prepare($sql);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$password);
        return $stmt->execute();
    }
    
    public function read(){
        $sql= "select * from $this->table";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id){
        $sql= "delete from $this->table where id=:id";
        $stmt= $this->conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        return $stmt->execute(); 
    }

    public function update($id, $name, $email, $password){
        $sql= "update $this->table set name=:name, email=:email, password= :password where id=:id";
        $stmt= $this->conn->prepare($sql);

        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$password);
        return $stmt->execute();
    }

    public function studentById($id){
        $sql="select * from $this->table where id=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}


?>