<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


include('config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["re_enter_password"];
    $firstname = $_POST['FirstName'];
    $lastname = $_POST['LastName'];
    $accountType = $_POST['accountType'];
    $dob = $_POST['dob'];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();

    // Basic validation
    if (empty($user) || empty($email) || empty($password) || empty($passwordRepeat) || empty($firstname) || empty($lastname) || empty($accountType) || empty($dob)) {
        array_push($errors, "All fields are required");
        header("Location:../registration.php");
        die();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
        header("Location:../registration.php");
        die();
    }

    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
        
        
        
    }

    if ($password !== $passwordRepeat) {
        array_push($errors, "Passwords do not match");
        
        
        
    }

    if (count($errors) == 0) {
        $sql = "INSERT INTO account (username, password, account_Type, first_Name, last_Name, dob, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("SQL statement preparation failed: " . mysqli_stmt_error($stmt));
        } else {
            mysqli_stmt_bind_param($stmt, "sssssss", $user, $passwordHash, $accountType, $firstname, $lastname, $dob, $email);
            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
                header("Location:../login_form.php");
            } else {
                die("Error executing statement: " . mysqli_stmt_error($stmt));
            }
        }
    } 
    else {
        // Display errors
        foreach ($errors as $error) {
            
            echo "<div class='alert alert-danger'>$error</div>";
            echo "<a href='../registration.php'>Go back</a>";
        }
    }
}
?>
