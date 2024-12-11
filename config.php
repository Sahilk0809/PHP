<?php

class Config
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "student";
    private $tableName = "students";
    private $connection;

    public function connect()
    {
        $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    public function __constructor()
    {
        $this->connect();
    }

    public function insertData($name, $age, $contact, $course)
    {
        $query = "INSERT INTO students (name, age, contact, course) VALUES ('$name', '$age', '$contact', '$course')";
        mysqli_query($this->connection, $query);
    }

    public function readData(){
        $query = "SELECT * FROM $this->tableName";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }

    public function updateData($id, $name, $age, $contact, $course){
        $query = "UPDATE $this->tableName SET name = '$name', age = $age, contact = $contact, course = '$course' WHERE id = $id";
        return $res = mysqli_query($this->connection, $query);
    }

    public function deletedata($id){
        $query = "DELETE FROM $this->tableName WHERE id = $id";
        return $res = mysqli_query($this->connection, $query);
    }
}

?>
