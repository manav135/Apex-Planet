<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('connect.php');
    
    extract($_POST);
    
    // Retrieve and sanitize inputs
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Name validation
    if (!empty($name)) {
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $errors['name'] = "Name field only allows letters and spaces.";
        }
    } else {
        $errors['name'] = "Name field is required.";
    }

    // Email validation
    if (!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format.";
        }
    } else {
        $errors['email'] = "Email field is required.";
    }

    // Phone validation
    if (!empty($phone)) {
        if (!preg_match('/^[0-9]{10}$/', $phone)) {
            $errors['phone'] = 'Contact Number must be exactly 10 digits.';
        }
    } else {
        $errors['phone'] = 'Contact Number field is required.';
    }

    // Password validation
    $passwordError = "";
    if (!empty($password) && !empty($confirmPassword)) {
        $password = htmlspecialchars($password);
        $confirmPassword = htmlspecialchars($confirmPassword);

        $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

        if ($password !== $confirmPassword) {
            $passwordError .= "Passwords do not match.\n";
        }
        if (!preg_match($password_pattern, $password)) {
            $passwordError .= "Password must have at least 8 characters, 1 uppercase, 1 lowercase, 1 number, and 1 special character.\n";
        }
    } else {
        $passwordError .= "Enter password and confirm it.\n";
    }

    if (!empty($passwordError)) {
        $errors['password'] = nl2br($passwordError);
    }

    // Proceed only if no errors
    if (count($errors) <= 0) {
        // Secure the input
        $name = htmlspecialchars($conn->real_escape_string($name));
        $email = htmlspecialchars($conn->real_escape_string($email));
        $phone = htmlspecialchars($conn->real_escape_string($phone));
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert into database
        $insert_statement = "INSERT INTO user (name, email, password, phone) VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($insert_statement);
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $phone);

        try {
            if ($stmt->execute()) {
                $_SESSION['success_msg'] = "New Member's Data has been registered successfully.";
                header('Location: ./');
                exit;
            }
        } catch (Exception $e) {
            $errors['error'] = "Database error: " . $e->getMessage();
        }

        $stmt->close();
    }

    $conn->close();
}
?>
