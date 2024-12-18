<?php
header("Access-Control-Allow-Method: POST");
header("Content-Type: application/json");

include "config.php";
$c1 = new Config();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_FILES['image'];
    $name = $image['name'];
    $tmp_name = $image['tmp_name'];
    $id = $_POST['id'];

    $uniqueId = uniqid("");
    $isImageUploaded = move_uploaded_file($tmp_name, "images/" . $uniqueId . $name);
    $mainPath = "images/" . $uniqueId . $name;

    if ($isImageUploaded) {

        $res = $c1->uploadImage($id, $name, $mainPath);
        if ($res) {
            $arr['msg'] = 'Image added successfully!';
        } else {
            http_response_code(400);
            $arr['error'] = 'Failed to add image';
        }
    } else {
        http_response_code(400);
        $arr['error'] = 'Images not uploaded!';
    }
} else {
    http_response_code(400);
    $arr['error'] = 'Only POST method is allowed';
}

echo json_encode($arr);
