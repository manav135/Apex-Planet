<?php
require_once __DIR__ . '/lib/DataSource.php';
$database = new DataSource();
if (isset($_POST["submit"])) {
    $sql = "INSERT INTO users(name, email, city) VALUES(?, ?, ?)";
    $paramType = 'sss';
    $paramValue = array(
        $_POST["name"],
        $_POST["email"],
        $_POST["city"]
    );
    $result = $database->insert($sql, $paramType, $paramValue);
    if (! $result) {
        $message = "problem in Adding to database. Please Retry.";
    } else {
        header("Location:index.php");
    }
}
?>
<html>

<head>

    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <link href="css/form.css" type="text/css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"
        type="text/javascript"></script>
    <script src="./js/validation.js" type="text/javascript"></script>
</head>

<body>
    <div class="phppot-container tile-container text-center">
        <form name="frmToy" method="post" action="" id="frmToy"
            onClick="return validate();">
            <?php if (! empty($message)) { ?>
                <div class="error">
                    <?php echo $message; ?>
                </div><?php } ?>
            <h1>Add Record</h1>
            <div class="row">
                <label class="text-left">Name: <span id="name-info"
                        class="validation-message"></span></label><input
                    type="text" name="name" id="name"
                    class="full-width ">
            </div>
            <div class="row">
                <label class="text-left">Email: <span id="email-info"
                        class="validation-message"></span></label> <input
                    type="email" name="email" id="email"
                    class="full-width ">
            </div>
            <div class="row">
                <label class="text-left">City: <span
                        id="phone-info" class="validation-message"></span></label><input
                    type="text" name="city" id="city"
                    class="full-width ">
            </div>
            <div class="row">
                <input type="submit" name="submit" id="btnAddAction"
                    class="full-width " value="Add" />
            </div>
        </form>
    </div>
</body>

</html>
