<?php
header("Access-Control-Allow-Method: DELETE");
header("Content-Type: application/json");

include "config.php";
$c1 = new Config();


if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $data = file_get_contents("php://input");
    parse_str($data, $result);

    $id = $result['id'];

    $fetch = $c1->fetchImageById($id);
    $data = mysqli_fetch_assoc($fetch);
    $unlinkData = $data['path'];
    $status = unlink($unlinkData);

    if ($status) {
        $res = $c1->deleteImage($id);
        if ($res) {
            $arr['msg'] = "Image deleted successfully!";
        } else {
            http_response_code(400);
            $arr["msg"] = "Images not deleted!";
        }
    } else {
        http_response_code(400);
        $arr["msg"] = "Images not deleted from server!";
    }


    // if ($res) {
    //     $arr['msg'] = 'Image added successfully!';
    // } else {
    //     $arr['error'] = 'Failed to add image';
    // }
} else {
    http_response_code(400);
    $arr['error'] = 'Only DELETE method is allowed';
}

echo json_encode($arr);
