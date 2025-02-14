<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    // Check if form fields exist before processing
    $formFields = ['fullname', 'email', 'phone', 'triptype', 'from', 'destination', 'date', 
                   'returndate', 'seats', 'preferences', 'adults', 'children', 
                   'gender', 'age', 'nationality'];

    $allFieldsPresent = true;
    foreach ($formFields as $field) {
        if (!isset($_POST[$field])) {
            $allFieldsPresent = false;
            break;
        }
    }

    if ($allFieldsPresent) {
        // Sanitize and validate inputs
        $fullname = filter_var(trim($_POST['fullname']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
        $triptype = filter_var(trim($_POST['triptype']), FILTER_SANITIZE_STRING);
        $from = filter_var(trim($_POST['from']), FILTER_SANITIZE_STRING);
        $destination = filter_var(trim($_POST['destination']), FILTER_SANITIZE_STRING);
        $date = trim($_POST['date']);
        $returndate = trim($_POST['returndate']);
        $seats = filter_var(trim($_POST['seats']), FILTER_VALIDATE_INT);
        $preferences = filter_var(trim($_POST['preferences']), FILTER_SANITIZE_STRING);
        $adult = filter_var(trim($_POST['adults']), FILTER_VALIDATE_INT);
        $children = filter_var(trim($_POST['children']), FILTER_VALIDATE_INT);
        $gender = filter_var(trim($_POST['gender']), FILTER_SANITIZE_STRING);
        $age = filter_var(trim($_POST['age']), FILTER_VALIDATE_INT);
        $nationality = filter_var(trim($_POST['nationality']), FILTER_SANITIZE_STRING);

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO booking (fullname, email, phone, triptype, `from`, destination, date, returndate, seats, preferences, adult, children, gender, age, nationality) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Correct binding format specifiers
        $stmt->bind_param("ssssssssissiiis", $fullname, $email, $phone, $triptype, $from, $destination, $date, $returndate, $seats, $preferences, $adult, $children, $gender, $age, $nationality);

        if ($stmt->execute()) {
            session_start();
            echo "<script>
                alert('Booking successful!');
                window.location.href = 'payment.html';
            </script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error: Some fields are missing.');</script>";
    }
}

$conn->close();
?>
