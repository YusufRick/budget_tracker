<?php

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $goal = $_POST["goal"];
}

$errors = array();

if (empty($goal)) {
    array_push($errors, "All fields are required");
    header("Location:../goal.php");
    die();
}


include('config.php');


    $username = $_SESSION['username'];
    $sql = "SELECT account_id FROM account WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $account_id = $row['account_id'];
        $monthly_savings = $goal/12;
        
        //insert data into goal table.
        $sql = "INSERT INTO goal (account_id, monthly_savings, 2024_goal) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $account_id, $monthly_savings, $goal);

        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='alert alert-success'>Expense is added.</div>";
            header("Location:../goal.php");
            
        } else {
            die("Error executing statement: " . mysqli_stmt_error($stmt));
        }
    } else {
        echo "Account not found for username: $username";
    }


?>
