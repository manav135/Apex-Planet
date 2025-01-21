<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}

// Sanitize input
$blogTitle = $conn->real_escape_string($_POST["blogtitle"]);
$blogDate = $conn->real_escape_string($_POST["blogdate"]);
$blogPara = $conn->real_escape_string($_POST["blogpara"]);

// Using prepared statements to prevent SQL injection
$sql = $conn->prepare("INSERT INTO blog_table (topic_title, topic_date, topic_para) VALUES (?, ?, ?)");
$sql->bind_param("sss", $blogTitle, $blogDate, $blogPara);

if($sql->execute()) {
    echo "";  // Success message can be added here
} else {
    echo "Error Saving Post: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Saved</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <div class="container" style="width: 50%; margin: auto; text-align: justify; font-family: Roboto, sans-serif;">
        <h1 style="margin-bottom: 10px; text-align: center;">Post Saved</h1>
        <center><a style="color: dodgerblue;" href="index.php">Go to Home Page</a></center>
        <br><br>
        
        <span style='font-weight: bold;' id='showTitle'><?php echo htmlspecialchars($blogTitle); ?></span>
        <br>
        <span id="showDate"><?php echo htmlspecialchars($blogDate); ?></span><br><br>
        
        <span id='showPara'><?php echo nl2br(htmlspecialchars($blogPara)); ?></span>
        <br><br>
    </div>
</body>
</html>
