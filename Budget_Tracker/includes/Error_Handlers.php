<?php

function IsEmailInvalid( string $email){
    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {

        return true;
    }
    else {
        return false;
    }


}

function IsUsernameTaken(object $pdo ,string $username){
    if (get_username($pdo,$username)) {

        return true;
    }
    else {
        return false;
    }
}

function is_email_registered(object $pdo, string $email){
    if (get_email($pdo,$email)) {

        return true;
    }
    else {
        return false;
    }
}
function IsInputEmpty( string $username, string $pwd, string $email, string $repassword, string $firstname,string $lastname,string $accType){
    if (empty($username) || empty($pwd) || empty($email) || empty($repassword)|| empty($firstname) || empty($lastname) ||empty($accType)) {

        return true;
    }
    else {
        return false;
    }


}

function get_username( object $pdo,string $username){

    $query = "SELECT username FROM account WHERE username = :username;";
    $stmt = $pdo-> prepare($query);
    $stmt -> bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;

}

function get_email( object $pdo,string $email){

    $query = "SELECT username FROM account WHERE email = :email;";
    $stmt = $pdo-> prepare($query);
    $stmt -> bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;

}