<?php

header("Access-Control-Allow-Method: POST");
header("Content-Type: application/json");
include "config.php";
$c1 = new Config();
$c1->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $course = $_POST['course'];

    $res = $c1->insertData($name, $age, $contact, $course);

    if($res){
        $arr['msg'] = "Successed";
    } else{
        $arr['msg'] = "Failed";
    }
} else {
    $arr['error'] = 'Only POST type is allowed';
}

echo json_encode($arr);

?>