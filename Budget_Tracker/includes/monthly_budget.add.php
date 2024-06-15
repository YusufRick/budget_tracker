<?php
session_start();

include('config.php');

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $month = $_POST["month"];
    $budget = $_POST["budget"];

    $username = $_SESSION['username'];
    $sql_account = "SELECT * FROM account WHERE username = ?";
    $stmt_account = $conn->prepare($sql_account);
    $stmt_account->bind_param("s", $username);
    $stmt_account->execute();
    $result_account = $stmt_account->get_result();

    if (empty($month) || empty($budget)) {
        array_push($errors, "All fields are required");
    }

    if ($result_account && $result_account->num_rows > 0) {
        $row = $result_account->fetch_assoc();
        $account_id = $row['account_id'];

        // Check if a budget in that month already exist or not
        $sql_check = "SELECT * FROM monthly_budget WHERE account_id = ? AND month = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("is", $account_id, $month);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check && $result_check->num_rows > 0) {
            $month_name = date("F", mktime(0, 0, 0, $month, 10));
            array_push($errors, "Budget for $month_name already exists");
            echo "<a href='../monthly_budget.php'> Back</a>";
            
        } else {
            
            $sql_insert = "INSERT INTO monthly_budget (account_id, month, budget) VALUES (?, ?, ?)";
            $stmt_insert = mysqli_prepare($conn, $sql_insert);
            mysqli_stmt_bind_param($stmt_insert, "iss", $account_id, $month, $budget);

            if (mysqli_stmt_execute($stmt_insert)) {
                echo "<div class='alert alert-success'>Monthly budget is added.</div>";
                header("Location: ../monthly_budget.php");
            } else {
                array_push($errors, "Error executing statement: " . mysqli_stmt_error($stmt_insert));
            }
        }
    } else {
        array_push($errors, "No account found.");
    }
}

foreach ($errors as $error) {
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

