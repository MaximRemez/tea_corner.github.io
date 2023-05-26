<?php
session_start();
require_once('db.php');

$login = $_POST['login'];
$password = $_POST['password'];

if(empty($login) || empty($password)){
    $_SESSION['error_log'] = "empty login or password";
    header('Location: ../Account.php');
    exit();
}
else{
    $sql = "SELECT * FROM `users` WHERE login = '$login' AND password = '$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0 ){
        $user = mysqli_fetch_assoc($result);

        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['login'];

        header('Location: ../LogAccount.php');
        exit();
    }
    else{
        $_SESSION['error_log'] = "wrong login or password";

        header('Location: ../Account.php');
        exit();
    }
}