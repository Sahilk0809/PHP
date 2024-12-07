<?php

include("config.php");
$c1 = new Config();

$btn_set = isset($_POST["button"]);

if ($btn_set) {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $contact = $_POST["contact"];
    $course = $_POST["course"];

    $c1->insertData($name, $age, $contact, $course);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Students Registration Form</title>
</head>

<body>
    <div class="form-container">
        <h1>Students Registration</h1>
        <form method="POST">
            <input placeholder="Name" name="name" required>
            <input placeholder="Age" type="number" name="age" required>
            <input placeholder="Phone" type="number" name="contact" required>
            <input placeholder="Course" type="text" name="course" required>
            <button name="button" type="submit">Submit</button>
        </form>
    </div>
</body>

</html>