<?php

header("Access-Control-Allow-Method: GET");
header("Content-Type: application/json");
include "config.php";
$c1 = new Config();
$c1->connect();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $res = $c1->readData();
    $students = [];
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            array_push($students, $data);
            $arr['data'] = $students;
        }
    } else {
        $arr["error"] = "Data not found!";
    }
} else {
    $arr['error'] = 'Only GET type is allowed';
}

echo json_encode($arr);

?>