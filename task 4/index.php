<?php
session_start();
require_once('submit.php')
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>From</title>
    <link rel="stylesheet" href="style.css">
    <linl rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h3>Registration Form</h3>
        <div class="row">
            <div class="col">
                <form action="" method="post">
                    <div class="form-group">
                        <!-- Display Error If Exists -->
                    <?php if(isset($errors['error']) && !empty($errors['error'])): ?>
                        <div class="msg-error"><?= $errors['error'] ?></div>
                    <?php endif; ?>

                    <!-- Display Success Message If Exists -->
                    <?php if(isset($_SESSION['success_msg']) && !empty($_SESSION['success_msg'])): ?>
                        <div class="msg-success"><?= $_SESSION['success_msg'] ?></div>
                        <?php unset($_SESSION['success_msg']); ?>
                    <?php endif; ?>

                    <label for="name">Name<sup><small class="required-field">*</small></sup></label>
                    <input type="text"  id="name" name="name" placeholder="Enter your name" autofocus value="<?= $_POST['name'] ?? "" ?>"><br>
                    <?php if(isset($errors['name']) && !empty($errors['name'])): ?>
                    <div class="error-msg"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                    
                    <label for="email">Email<sup><small class="required-field">*</small></sup></label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= $_POST['email'] ?? "" ?>"><br>
                    <?php if(isset($errors['email']) && !empty($errors['email'])): ?>
                    <div class="error-msg"><?= $errors['email'] ?></div>
                    <?php endif; ?>

                    <label for="password">Password<sup><small class="required-field">*</small></sup></label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" value="<?= $_POST['password'] ?? "" ?>"><br>
                    <?php if(isset($errors['password']) && !empty($errors['password'])): ?>
                    <div class="error-msg"><?= $errors['password'] ?></div>
                    <?php endif; ?>
                    
                    <label for="confirmpassword">Confirm Password<sup><small class="required-field">*</small></sup></label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your confirm password" value="<?= $_POST['confirm_password'] ?? "" ?>"><br>
                    

                    <label for="phone">Phone<sup><small class="required-field">*</small></sup></label>
                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" value="<?= $_POST['phone'] ?? "" ?>"><br>                
                    <?php if(isset($errors['phone']) && !empty($errors['phone'])): ?>
                    <div class="error-msg"><?= $errors['phone'] ?></div>
                    <?php endif; ?>
                    
                    <button type="submit" id="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>          
    </div>>
</body>
</html>
