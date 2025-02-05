<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

try{
    // Connect Database
    $conn= new MySQLi($host, $username, $password, $dbname);
}catch (Exception $e){
    // Display Error if Database Conenction Failed
    throw new ErrorException($e->getMessage());
    exit;
}

?>
