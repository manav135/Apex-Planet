<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        form{
            margin: 0 auto;
            width: 50%;
            padding: 30px;
            border: 5px solid #b40909;
            border-radius: 10px;
        }
        input{
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
        input[type="submit"]{
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover{
            background-color: #45a049;
        }
        body{
            background-color: skyblue;
        }
    </style>    
</head>
<body>

    <form>
        <label for="fristname">FristName: </label>
        <input type="text" name="fristname" id="fristname">
        <br>
        <label for="lastname">LastName: </label>
        <input type="text" name="lastname" id="lastname">
        <br>
        <label for="email">Email: </label>
        <input type="email" name="email" id="email">
        <br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" value="Submit">
    </form>

</body>
</html>

<?php
    if(isset($_GET['fristname']) && isset($_GET['lastname']) && isset($_GET['email']) && isset($_GET['password'])){
        $fristname = $_GET['fristname'];
        $lastname = $_GET['lastname'];
        $email = $_GET['email'];
        $password = $_GET['password'];
        echo "Fristname:  $fristname <br> Lastname: $lastname <br> Email: $email <br> Password: $password";
    }
?>
