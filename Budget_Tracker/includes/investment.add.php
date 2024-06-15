
<?php
session_start();

include('config.php');

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $name = $_POST["name"];
    $purchase_price = $_POST['purchase_price'];
    $current_price = $_POST['current_price'];

    $username = $_SESSION['username'];
    $sql_account = "SELECT * FROM account WHERE username = ?";
    $stmt_account = $conn->prepare($sql_account);
    $stmt_account->bind_param("s", $username);
    $stmt_account->execute();
    $result_account = $stmt_account->get_result();

    if (empty($date) || empty($name) || empty($purchase_price) || empty($current_price)) {
        array_push($errors, "All fields are required");
    }
            
    else {
        if ($result_account && $result_account->num_rows > 0) {
            $row = $result_account->fetch_assoc();
            $account_id = $row['account_id'];
            
            $sql_insert = "INSERT INTO investment (account_id, date, name, purchase_Price, current_Price) VALUES (?, ?, ?, ?,?)";
            $stmt_insert = mysqli_prepare($conn, $sql_insert);
            mysqli_stmt_bind_param($stmt_insert, "issss", $account_id, $date, $name,$purchase_price,$current_price);

            if (mysqli_stmt_execute($stmt_insert)) {
                echo "<div class='alert alert-success'>Investment budget is added.</div>";
                header("Location: ../investment.php");
            } else {
                array_push($errors, "Error executing statement: " . mysqli_stmt_error($stmt_insert));
            }
        }
    }
        
}

foreach ($errors as $error) {
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

