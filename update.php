<?php

include "config.php";
$c1 = new Config();
$c1->connect();

session_start();

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$age = $_SESSION['age'];
$contact = $_SESSION['contact'];
$course = $_SESSION['course'];

$error_message = "";

if (isset($_POST['update'])) {

    $name = trim($_POST['name']);
    $age = intval($_POST['age']);
    $contact = trim($_POST['contact']);
    $course = trim($_POST['course']);

    // Validation
    if (empty($name) || empty($age) || empty($contact) || empty($course)) {
        $error_message = "All fields are required.";
    } elseif (str_word_count($name) < 2) {
        $error_message = "Name must be at least 2 words.";
    } elseif ($age <= 0 || $age > 100) {
        $error_message = "Age must be between 1 and 100.";
    } elseif (!preg_match("/^\d{10}$/", $contact)) {
        $error_message = "Phone number must be exactly 10 digits.";
    } else {
        $c1->updateData($id, $name, $age, $contact, $course);
        header('Location: index.php');
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            background: linear-gradient(to bottom right, #4facfe, #00f2fe);
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 40px;
            animation: fadeIn 1s ease-in-out;
        }

        .form-container h1 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group input {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
        }

        .form-container button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Top Section: Update Form -->
        <div class="form-container mx-auto col-md-6">
            <h1>Update Student Information</h1>
            <?php if (!empty($error_message)) { ?>
                <div class="error-message"> <?php echo $error_message; ?> </div>
            <?php } ?>
            <form method="POST">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Full Name" value="<?php echo $name ?>" required>
                </div>
                <div class="input-group">
                    <input type="number" name="age" placeholder="Age" value="<?php echo $age ?>" required>
                </div>
                <div class="input-group">
                    <input type="number" name="contact" placeholder="Phone Number" value="<?php echo $contact ?>"
                        required>
                </div>
                <div class="input-group">
                    <input type="text" name="course" placeholder="Course" value="<?php echo $course ?>" required>
                </div>
                <button type="submit" name="update">Update</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
