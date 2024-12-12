<?php

header("Access-Control-Allow-Method: POST, GET, PUT, DELETE");
header("Content-Type: application/json");
include "config.php";

$c1 = new Config();
$c1->connect();

$arr = [];

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $name = $_POST['name'];
        $age = $_POST['age'];
        $contact = $_POST['contact'];
        $course = $_POST['course'];

        $res = $c1->insertData($name, $age, $contact, $course);

        $res ? $arr['msg'] = "Insertion Completed!" :
            $arr['msg'] = "Failed to insert data!";

        break;

    case 'GET':
        $res = $c1->readData();
        $students = [];

        if ($res) {
            while ($data = mysqli_fetch_assoc($res)) {
                array_push($students, $data);
            }
            $arr['data'] = $students;
        } else {
            $arr['error'] = "Data not found!";
        }
        break;

    case 'PUT':
        $data = file_get_contents("php://input");
        parse_str($data, $result);

        $id = $result['id'];
        $name = $result['name'];
        $age = $result['age'];
        $contact = $result['contact'];
        $course = $result['course'];

        $res = $c1->updateData($id, $name, $age, $contact, $course);

        $res ?
            $arr['msg'] = "Updated data!" :
            $arr['msg'] = "Failed to update data!";

        break;

    case 'DELETE':
        $data = file_get_contents("php://input");
        parse_str($data, $result);

        $id = $result['id'];
        $res = $c1->deleteData($id);

        $res ?
            $arr['msg'] = "Data deleted successfully!" :
            $arr['msg'] = "Failed to delete data!";

        break;

    default:
        $arr['error'] = "Invalid request type!";
        break;
}

echo json_encode($arr);
