<?php
require_once "config.php";

if(isset($_POST["investment_id"])) {
    $id = mysqli_real_escape_string($conn, $_POST["investment_id"]);
    $query = "DELETE FROM investment WHERE investment_id = '$id'";
    if (mysqli_query($conn, $query)) {
        header("Location:../investment.php");
        exit();
    } else {
         echo "Something went wrong. Please try again later.";
    }
} else {
    echo "investment ID not provided.";
}
?>