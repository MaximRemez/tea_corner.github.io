<?php
session_start();
/*$_SESSION['id']=null;*/
$_SESSION['error_log']=null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    $_SESSION['id'] = null;
    header('Location: Account.php');
    exit;
}
?>

<?php
$connect = mysqli_connect("localhost", "root", "qwerty", "register_user");

if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>window.location="Account.php"</script>';
            }
        }
    }
}
?>

<!DOCTYPE HTML>

<html>

<head>
    <meta charset ="UTF-8">
    <link rel="stylesheet" href="assets/css/StyleGeneral.css" />
    <link rel="stylesheet" href="assets/css/StyleMenu.css" />
    <link rel="icon" href="assets/images/CafeIcon.ico" type="image/x-icon">

    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=IBM+Plex+Serif:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

  <title>Account</title>
</head>

<body>

<header class="header">
    <div class="container">
        <div class="header_inner">

            <div style="display: inline-flex; vertical-align: middle;">
           <a class="header_logo" href="index.html"><img src="assets/images/TeaCorner.png" alt="" width = "140px" height = "140px"/></a>
           <div class="header_underlogo"><p>Welcome, <?php echo $_SESSION['login']; ?>!</p></div>
            </div>

           <nav class="nav">
               <a class="nav_link" href="index.html">Main</a>
               <a class="nav_link" href="Menu.php">Menu</a>
               <a class="nav_link" href="Events.html">Events</a>
               <a class="nav_link" href="Map.html">Map</a>
               <a class="nav_link" href="Account.php"><iconify-icon icon="carbon:user-filled"></iconify-icon></a>
               <a class="nav_link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><iconify-icon icon="material-symbols:exit-to-app-rounded"></iconify-icon></a>
               

           </nav>

           <form id="logout-form" method="POST" style="display: none;">
           <input type="hidden" name="logout" value="1">
           </form>

        </div>
    </div>
</header>

<section class="section">
      <div class="container">
          <div class="section_header">
              <h3 class="section_suptitle">Your delicious order</h3>
              <h2 class="section_title">List</h2>

<div class="table-responsive" align="center">
                <table class="plusborder" width=75% align=-50% >
                    <tr class="plusborder">
                        <td width="40%" class="plusborder"><b>Name</b></td>
                        <td width="10%" class="plusborder"><b>Count</b></td>
                        <td width="20%" class="plusborder"><b>Price</b></td>
                        <td width="15%" class="plusborder"><b>Summary</b></td>
                        <td width="5%" class="plusborder">&nbsp;</td>
                    </tr>
                    <?php
                    if(!empty($_SESSION["shopping_cart"]))
                    {
                        $total = 0;
                        foreach($_SESSION["shopping_cart"] as $keys => $values)
                        {
                    ?>
                    <tr class="plusborder">
                        <td width="40%" class="plusborder"><?php echo $values["item_name"]; ?></td>
                        <td width="10%" class="plusborder"><?php echo $values["item_quantity"]; ?></td>
                        <td width="20%" class="plusborder">$ <?php echo $values["item_price"]; ?></td>
                        <td width="15%" class="plusborder">$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                        <td align="right" width="5%" class="plusborder"><a href="LogAccount.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="delete_button">Delete</span></a></td>
                    </tr>
                    <?php
                            $total = $total + ($values["item_quantity"] * $values["item_price"]);
                        }
                    ?>
                    <tr>
                        <td colspan="3" align="right" class="plusborder">Summary</td>
                        <td align="right" class="plusborder">$ <?php echo number_format($total, 2); ?></td>
                        <?php
                        $ids = "";
                        foreach($_SESSION["shopping_cart"] as $keys => $values)
                        {
                            $ids .= $values["item_id"];  
                            $ids .= "\n";
                        }
                        ?>
                        <td><form action="Order.php" method="post">
                            <input type="hidden" name="ids" value=<?php echo $ids; ?> />
                            <input class="make_order" type="submit" value="Make delivery"/>
                        </form></td>
                    </tr>
                    <?php
                    }
                    ?>

                </table>

                </div>    
          </div>
      </div>
  </section>

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