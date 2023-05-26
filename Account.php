<?php
session_start();
if(isset($_SESSION['id'])){
  header('Location: LogAccount.php');
  exit();
}
elseif(isset($_SESSION['error_log'])){
    $error_log = $_SESSION['error_log'];
    echo "<script>alert('" . $error_log . "');</script>";
    
    unset($_SESSION['error_log']);
}
?>

<!DOCTYPE HTML>

<html>

<head>
    <meta charset ="UTF-8">
    <link rel="stylesheet" href="assets/css/StyleGeneral.css" />
    <link rel="stylesheet" href="assets/css/StyleAccount.css" />
    <link rel="icon" href="assets/images/CafeIcon.ico" type="image/x-icon">

    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=IBM+Plex+Serif:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

  <title>Account</title>                
</head>

<body>

    <div class="container">
        <div class="container_content">
    
            <a class="logo" href="index.html"></a>
    
            <form class="window" action="backend/login.php" method="post">
                <div class="reg_head">Sign in</div>
    
                <div class="field_info">Input username</div>
                <input type="text" placeholder="Input your username" class="field" required maxlength="30" minlength="3" name="login">
    
                <div class="field_info">Input password</div>
                <input type="password" placeholder="At least 6 characters" class="field" required maxlength="50" minlength="6" name="password">
    
                <input type="submit" value="Entry" class="continue">
    
                <a class="reg_new" href="RegisterAccount.php">Register</a>
    
            </form>
    
        </div>
    </div>

<footer class="bottom_back">
   <div class="container">
       <div class="contacts">

       <div class="reservation">
           <div class="info">Table reservation</div>
           <div class="info">TeaCorner@gmail.com</div>
           <div class="info">+380 96 696 77 77</div>
       </div>

       <div class="time">
           <div class="info">Working hours</div>
           <div class="info">09:00 - 23:00</div>
           <div class="info">Everyday</div>
       </div>

            <div class="soc">
               <a class="soc_link" href="https://instagram.com/teacorner?igshid=YmMyMTA2M2Y=">Instagram  <iconify-icon icon="icon-park-solid:instagram"></iconify-icon></a>
               <a class="soc_link" href="https://www.facebook.com/teacorner22">Facebook  <iconify-icon icon="brandico:facebook-rect"></iconify-icon></a>
               <a class="soc_link" href="https://twitter.com/teacorner?s=21&t=LAYX9poQgN9c9HZhmGwuTw">Twitter  <iconify-icon icon="fa:twitter-square"></iconify-icon></a>
            </div>
       </div>
   </div>
</footer>

</body>

</html>