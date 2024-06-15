<?php
session_start();

// check if user are logged in
if (!isset($_SESSION['username'])) {
    header("Location: login_form.php");
    exit();
}

include('config.php');

$username = $_SESSION['username'];
$sql = "SELECT * FROM account WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    header("Location: login_form.php");
    exit();
}

$stmt->close();
$conn->close();
?>
