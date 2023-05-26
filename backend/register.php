<?php
session_start();
require_once('db.php');

$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];

if(empty($login) || empty($email) || empty($password) || empty($repeat_password)){
   $_SESSION['error_log'] = "Fill all field";
    header('Location: ../RegisterAccount.php');
    exit();
}
else{
     if($password != $repeat_password){
        $_SESSION['error_log'] = "password mismatch";
        header('Location: ../RegisterAccount.php');
        exit();
     }  
     else{
     $sql = "INSERT INTO `users` (login, password, email) VALUES ('$login', '$password', '$email')";
    
         if($conn -> query($sql)){
            header('Location: ../Account.php');
            exit();
         }
         else{
            $_SESSION['error_log'] = "lost connect with host";
            header('Location: ../RegisterAccount.php');
            exit();
         }
     }
}

