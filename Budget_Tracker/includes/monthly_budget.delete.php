<?php
require_once "config.php";

if(isset($_POST["budget_id"])) {
    $budgetid = mysqli_real_escape_string($conn, $_POST["budget_id"]);
    $query = "DELETE FROM monthly_budget WHERE budget_id = '$budgetid'";
    if (mysqli_query($conn, $query)) {
        header("Location:../monthly_budget.php");
        exit(); 
    } else {
         echo "Something went wrong. Please try again later.";
    }
}
?>




