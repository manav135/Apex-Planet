<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Using PHP And MySQL</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
  <div class="top-bar">
    <span id="topBarTitle">Blog | All Posts</span>
  </div>
  <br>
  
  <div class="all-posts-container">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "blog_db";
    // Establishing Database Connection
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
      die("Connection Error: " . $conn->connect_error);
    }
    // Fetching Blog Posts
    $sql = "SELECT topic_title, topic_date, topic_para FROM blog_table";
    $result = $conn->query($sql);
    // Display Posts if Available
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) { ?>
      <div class='post-container' style='padding: 25px; border: 1px solid #ddd; margin-bottom: 20px; border-radius: 10px;'>
        <h2 id='displayTitle'><?= htmlspecialchars($row["topic_title"]) ?></h2>
        <span id='displayDate'><?= htmlspecialchars($row["topic_date"]) ?></span><br><br>
        <p style='overflow: hidden; display: -webkit-box; -webkit-line-clamp: 10; -webkit-box-orient: vertical; line-clamp: 10;' id='displayPara'>
          <?= nl2br(htmlspecialchars($row["topic_para"])) ?>
        </p>
      </div>
      <?php 
      }
    } else { 
      echo "<center><span>No Blog Posts Found</span></center>";
      }
      $conn->close();
    ?>
  </div>
  <!-- Write a New Post Button -->
  <br>
  <center>
    <a style='color: dodgerblue; text-decoration: none; background: dodgerblue; padding: 5px 25px; color: #fff; border-radius: 50px;' href='index.html'>Write a New Post</a>
  </center>
  <br>

</body>
</html>
