<?php
session_start();
$connect = mysqli_connect("localhost", "root", "qwerty", "register_user");
?>

<!DOCTYPE HTML>

<html>

<head>
    <meta charset ="UTF-8">
    <link rel="stylesheet" href="assets/css/StyleGeneral.css" />
    <link rel="stylesheet" href="assets/css/StyleMenu.css" />

    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=IBM+Plex+Serif:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

  <title>Order</title>

<style>
body {
    background-color: #f9f8e6;
}
</style>
</head>

<body>

<section class="section_order">
      <div class="container">
      <a class="logo" href="index.html"></a>
          <div class="section_header">

        <form action="backend/save_order.php" method="POST" class="form_border">

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
                        <td></td>
                    </tr>
                    <?php
                    }
                    ?>

                </table>

                </div>   

                <div class="fields">
          <div class="column_form">
          <h2 class="section_title">Order</h2>

            <label for="last_name">Surname</label>
            <input type="text" id="last_name" name="surname" placeholder="" required maxlength="30" minlength="2">
            <label for="first_name">Name</label>
            <input type="text" id="first_name" name="name" placeholder="" required maxlength="30" minlength="2">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="your_mail@gmail.com">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="">
            <label for="phone">Telephone number</label>
            +&nbsp;<input type="phone" id="phone" name="phone" placeholder="" required>
            <label for="way_obt">Way to get</label>
            <input type="radio" id="pickupCafe" name="way_get" value="Pickup from the cafe"> Pickup from the cafe<br>
            <input type="radio" id="courier" name="way_get" value="Courier"> Courier<br><br>
            <label for="pay">Way to pay</label>
            <input type="radio" id="card" name="way_pay" value="Payment by card"> Payment by card<br>
            <input type="radio" id="money" name="way_pay" value="Cash payment"> Cash payment<br>
            <br>
            <input type="submit" name="ok" value="Checkout" class="btn">
          </div>
        </div>
      </form>
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

<?php
mysqli_close($connect);
?>