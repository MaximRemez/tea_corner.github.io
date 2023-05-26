<?php
session_start();
ob_start();
$connect = mysqli_connect("localhost", "root", "qwerty", "register_user");
?>

<?php
    $ids = "";
    $total = 0;
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
        $ids .= $values["item_id"];
        $ids .= " ";
        $total = $total + ($values["item_quantity"] * $values["item_price"]);
    }

    $delivery_address =  $_POST['address'];
    $way_get =  '';
    if($_POST['way_get'] == "Pickup from the cafe")
    {
        $way_get = 'pickup_cafe';
    }
    else
    {
        $way_get =  'courier';
    }

    $payment  =  '';
    if($_POST['way_pay'] == "Payment by card")
    {
        $way_payment = 'card';
    }
    else
    {
        $way_payment =  'cash';
    }
    $surname =   $_POST['surname'];
    $name =   $_POST['name'];
    $foods =   trim($ids);
    $email =   $_POST['email'];
    $phone =   $_POST['phone'];
    $price =   $total;
    $status = 'new';

$insert = "delivery_address = '{$delivery_address}', way_get = '{$way_get}', way_payment = '{$way_payment}', surname = '{$surname}', name = '{$name}', foods = '{$foods}', email = '{$email}', phone = '{$phone}', price = '{$price}', status = '{$status}'";
?>

<!DOCTYPE HTML>

<html>

<head>
    <meta charset ="UTF-8">
    <link rel="stylesheet" href="assets/css/StyleGeneral.css" />
    <link rel="stylesheet" href="assets/css/StyleMenu.css" />

    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=IBM+Plex+Serif:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

  <title>SaveOrder</title>

<style>
body {
    background-color: #f9f8e6;
}
</style>
</head>

<body>

<h3>
<?php
        $zapros= "INSERT INTO orders SET {$insert};";
        mysqli_query($connect, $zapros);
        if (mysqli_affected_rows($connect) > 0)
        {
            unset($_SESSION['shopping_cart']);
            header("Location: ../index.html");
            ob_end_flush();
            exit;
        }
        else
        {
            echo "An error occurred during checkout:(<br>";
            echo "<a href=\"index.html\">Back to main</a>";
        }
?>
</h3>




</body>
</html>