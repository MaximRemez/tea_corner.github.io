<?php

$servername = "localhost";
$username = "root";
$password = "qwerty";
$db_name = "register_user";

$conn = mysqli_connect($servername, $username, $password, $db_name);

if(!$conn){
    die("Connection failed");
}
else{
    "Successful connection";
}

?>