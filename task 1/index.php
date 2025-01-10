<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        form {
            margin: 0 auto;
            width: 50%;
            padding: 30px;
            border: 5px solid #b40909;
            border-radius: 10px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        body {
            background-color: skyblue;
        }
    </style>
</head>
<body>

    <form method="post" action="">
        <label for="firstname">FirstName: </label>
        <input type="text" name="firstname" id="firstname" placeholder="Enter your firstname" required>
        <br>
        <label for="lastname">LastName: </label>
        <input type="text" name="lastname" id="lastname" placeholder="Enter your lastname" required>
        <br>
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>
        <br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
        <br>
        <input type="submit" value="Submit" name="submit">
    </form>

</body>
</html>

<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "form";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);

    if ($stmt->execute()) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();


?>
