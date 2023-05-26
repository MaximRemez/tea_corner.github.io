<?php
session_start();
$connect = mysqli_connect("localhost", "root", "qwerty", "register_user");

if(isset($_POST["add_to_basket"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = my_array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'			=>	$_GET["id"],
                'item_name'			=>	$_POST["name"],
                'item_price'		=>	$_POST["price"],
                'item_quantity'		=>	$_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            $index = array_search($_GET["id"], $item_array_id);
            $_SESSION["shopping_cart"][$index]["item_quantity"] += 1;
        }
    }
    else
    {
        $item_array = array(
            'item_id'			=>	$_GET["id"],
            'item_name'			=>	$_POST["name"],
            'item_price'		=>	$_POST["price"],
            'item_quantity'		=>	$_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}

if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>window.location="menu.php"</script>';
            }
        }
    }
}
?>

<!DOCTYPE HTML>

<html>

<head>
    <meta charset ="UTF-8">
    <link rel="icon" href="assets/images/CafeIcon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/StyleGeneral.css" />
    <link rel="stylesheet" href="assets/css/StyleMenu.css" />

    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=IBM+Plex+Serif:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

  <title>Menu</title>
</head>

<body>

<header class="header">
    <div class="container">
        <div class="header_inner">

            <div style="display: inline-flex; vertical-align: middle;">
           <a class="header_logo" href="index.html"><img src="assets/images/TeaCorner.png" alt="" width = "140px" height = "140px"/></a>
           <div class="header_underlogo"><p>Menu</p></div>
            </div>

           <nav class="nav">
               <a class="nav_link" href="index.html">Main</a>
               <a class="nav_link" href="Menu.php">Menu</a>
               <a class="nav_link" href="Events.html">Events</a>
               <a class="nav_link" href="Map.html">Map</a>
               <a class="nav_link" href="Account.php"><iconify-icon icon="carbon:user-filled"></iconify-icon></a>
           </nav>

        </div>
    </div>
</header>

<section class="menu_section">
    <nav class="menu_nav">
        <a class="menu_nav_link" href="#tea">Tea</a>
        <a class="menu_nav_link" href="#coffee">Coffee</a>
        <a class="menu_nav_link" href="#desserts">Desserts</a>
    </nav>
</section>

<section class="section">
      <div class="container">
          <div class="section_header">
              <h3 class="section_suptitle">What is our food</h3>
              <h2 class="section_title">About menu</h2>
              <div class="section_text">
                  <p>It was originally a tea house. That's why we have a wide selection of teas on our menu.
                  However, now we have expanded the range.
                  It also serves coffee and various desserts.</p>
              </div>
          </div>
      </div>
  </section>

<div class="transition"></div>

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
                        <td align="right" width="5%" class="plusborder"><a href="menu.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="delete_button">Delete</span></a></td>
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
            


<div class="transition"></div>

<section class="section">
      <div class="container">
           <a name="tea"></a>
        <h2 class="menu_title">Tea</h2>

          <div class="menu">

          <?php
                $query = "SELECT * FROM products WHERE category=\"Tea\"";
                $result = mysqli_query($connect, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>

                <form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">
                <?
                    $show_img = base64_encode($row['image']);
                    ShowProduct ($show_img, $row['name'], $row['price']);
                ?>
                </form>
                <?
                }
                }
                ?>

          </div>

      </div>
</section>

<div class="transition"></div>

<section class="section">
      <div class="container">
          <a name="coffee"></a>
        <h2 class="menu_title">Coffee</h2>

          <div class="menu">

          <?php
                $query = "SELECT * FROM products WHERE category=\"Coffee\"";
                $result = mysqli_query($connect, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>

                <form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">
                <?
                    $show_img = base64_encode($row['image']);
                    ShowProduct ($show_img, $row['name'], $row['price']);
                ?>
                </form>
                <?
                }
                }
                ?>

          </div>

      </div>
</section>

<div class="transition"></div>

<section class="section">
      <div class="container">
          <a name="desserts"></a>
        <h2 class="menu_title">Desserts</h2>

          <div class="menu">
          
          <?php
                $query = "SELECT * FROM products WHERE category=\"Dessert\"";
                $result = mysqli_query($connect, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>

                <form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">
                <?
                    $show_img = base64_encode($row['image']);
                    ShowProduct ($show_img, $row['name'], $row['price']);
                ?>
                </form>
                <?
                }
                }
                mysqli_close($connect);
                ?>

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

</html>

<?php
function ShowProduct ($image, $name, $price)
{
echo "<div class=\"element\">";
  echo "<div class=\"image_hold\">";
     echo "<img class=\"image\" src='data:image/jpeg;base64, ". $image ."' alt=\"assets\">";
  echo "</div>";
  echo "<div class=\"content_hold\">";
     echo "<div class=\"element_name\">{$name}</div>";
     echo "<input type=\"hidden\" name=\"name\" value=\"{$name}\" /> ";
     echo "<input type=\"hidden\" name=\"price\" value=\"{$price}\" /> ";
     echo "<input type=\"hidden\" name=\"quantity\" value=\"1\" /> ";
     echo "<div class=\"buy_holder\">";
        echo "<div class=\"element_price\">{$price} $</div>";
        echo "<input type=\"submit\" name=\"add_to_basket\" class=\"buy_button\" value=\"Buy\">";
     echo "</div>";
  echo "</div>";
echo "</div>";
}

function my_array_column($array, $column_name) {
    return array_map(function($element) use($column_name){return $element[$column_name];}, $array);
}
?>