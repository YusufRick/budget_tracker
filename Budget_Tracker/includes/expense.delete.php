<?php
require_once "config.php";

if(isset($_POST["expense_id"])) {
    
    $id = mysqli_real_escape_string($conn, $_POST["expense_id"]);
    
    $query = "DELETE FROM expense WHERE expense_id = '$id'";
    if (mysqli_query($conn, $query)) {
        header("Location:../expense.php");
        exit();
    } else {
         echo "Something went wrong. Please try again later.";
    }
} else {
    echo "Expense ID not provided.";
}
?>
