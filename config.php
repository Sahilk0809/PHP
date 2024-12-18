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

    public function __construct()
    {
        $this->connect();
    }

    public function uploadImage($id, $image, $path)
    {
        $query = "INSERT INTO images (id, image, path) VALUES ($id, '$image', '$path')";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }

    public function fetchImage()
    {
        $query = "SELECT * FROM images";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }

    public function fetchImageById($id)
    {
        $query = "SELECT * FROM images WHERE id = $id";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }

    public function deleteImage($id)
    {

        // $image = $this->fetchImageById($id);
        // $filename = mysqli_fetch_assoc($image);
        // $status = unlink($filename['path']);
        // if ($status) {
        //     $query = "DELETE FROM images WHERE id = $id";
        //     mysqli_query($this->connection, $query);
        // } else{

        // }
        $query = "DELETE FROM images WHERE id = $id";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }

    public function insertData($name, $age, $contact, $course)
    {
        $query = "INSERT INTO students (name, age, contact, course) VALUES ('$name', '$age', '$contact', '$course')";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }

    public function readData()
    {
        $query = "SELECT * FROM $this->tableName";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }

    public function updateData($id, $name, $age, $contact, $course)
    {
        $query = "UPDATE $this->tableName SET name = '$name', age = $age, contact = $contact, course = '$course' WHERE id = $id";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }

    public function deletedata($id)
    {
        $query = "DELETE FROM $this->tableName WHERE id = $id";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }
}
