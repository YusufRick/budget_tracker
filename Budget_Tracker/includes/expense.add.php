<?php

session_start(); // Start session (assuming user is logged in)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $amount = $_POST["amount"];
    $description = $_POST["description"];
    $category_name = $_POST["category"]; 
}
function formatDate($date) {
    return date('Y-m-d', strtotime($date));
}

$errors = array();

if (empty($date) || empty($amount) || empty($description) || empty($category_name)) {
    array_push($errors, "All fields are required");
    header("Location:../expense.php");
    die();
}

include('config.php');

$date=formatDate($date);

$sql = "SELECT category_id FROM expense_category WHERE category_Name = ?"; // Check if the category exists in the expense_category table
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $category_name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $category_id = $row['category_id'];
    
    // fetch acc id
    $username = $_SESSION['username'];
    $sql = "SELECT account_id FROM account WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $account_id = $row['account_id'];
        
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $budget_id = $row['budget_id'];
            
            // Insert data using sql statement
            $sql = "INSERT INTO expense (account_id, date, category_id, amount, description) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "isiis", $account_id, $date, $category_id, $amount, $description);

            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success'>Expense is added.</div>";
                header("Location:../expense.php");
            } else {
                die("Error executing statement: " . mysqli_stmt_error($stmt));
            }
        } 
    } else {
        echo "Account not found for username: $username";
    }
} else {
    echo "Category does not exist in the database.";
}

?>
