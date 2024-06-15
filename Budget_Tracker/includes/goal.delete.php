<?php
require_once "config.php";

if(isset($_POST["goal_id"])) {
    $id = mysqli_real_escape_string($conn, $_POST["goal_id"]);
    
   
    $query = "DELETE FROM goal WHERE goal_id = '$id'";
    if (mysqli_query($conn, $query)) {
        header("Location:../goal.php");
        exit(); 
    } else {
         echo "Something went wrong. Please try again later.";
    }
} 
?>
