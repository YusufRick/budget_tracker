<?php
session_start();

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

// Validate user input
    if (empty($username) || empty($password)) {
        $error = "Both username and password are required";
    } else {
// Check if user exists in the database
        $sql = "SELECT * FROM account WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            if (password_verify($password, $passwordHash)) {
                $_SESSION['username'] = $username;
                header("Location: ../dashboard.php");
                exit();
            } else {
                $error = "Invalid password. <a href='../login_form.php'>Go back to login</a>";
            }
        } else {
            $error = "User not found. . <a href='../login_form.php'>Go back to login</a>";
        }
    }
    if (isset($error)) {
        echo "<div style='color: red;'>$error</div>";
    }
}
?>


