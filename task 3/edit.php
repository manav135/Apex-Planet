<?php
require_once __DIR__ . '/lib/DataSource.php';
$database = new DataSource();
if (! empty($_POST["submit"])) {
    $sql = "UPDATE users SET name=?, email=?, city=? WHERE id=?";
    $paramType = 'sssi';
    $paramValue = array(
        $_POST["name"],
        $_POST["email"],
        $_POST["city"],
        $_GET["id"]
    );
    $result = $database->execute($sql, $paramType, $paramValue);
    if (! $result) {
        $message = "problem in Editing! Please Retry!";
    } else {
        header("Location:index.php");
    }
}
$sql = "SELECT * FROM users WHERE id=?";
$paramType = 'i';
$paramValue = array(
    $_GET["id"]
);
$result = $database->select($sql, $paramType, $paramValue);
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/form.css" />
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
            <h1>Edit Record</h1>
            <div class="row">
                <label class="text-left">Name: <span id="name-info"
                        class="validation-message"></span></label> <input
                    type="text" name="name" id="name" class="full-width"
                    value="<?php echo $result[0]["name"]; ?>">
            </div>
            <div class="row">
                <label class="text-left">Email: <span id="emai;-info"
                        class="validation-message"></span></label> <input
                    type="text" name="email" id="email" class="full-width"
                    value="<?php echo $result[0]["email"]; ?>">
            </div>
            <div class="row">
                <label class="text-left">City: <span
                        id="city-info" class="validation-message"></span></label><input
                    type="text" name="city" id="city"
                    class="full-width"
                    value="<?php echo $result[0]["city"]; ?>">
            </div>
            <div class="row">
                <input type="submit" name="submit" id="btnAddAction"
                    class="full-width " value="Save" />
            </div>
        </form>
    </div>
</body>

</html>
