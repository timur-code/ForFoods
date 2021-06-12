<?php
	session_start();

	include("php/connection.php");
	include("php/functions.php");

	$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>History</title>
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran&family=Courgette&family=Dancing+Script:wght@700&family=Lobster&family=Montserrat+Alternates:ital@1&display=swap" rel="stylesheet"> 
    
    <!--Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <!--Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    
    <!--Own css-->
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/text.css">
	<link href="css/cart.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
  insert_nav('sections');
?>
	<div class="wrap cf">
		<h1 class="projTitle">History of orders</h1>
        <div class="heading cf">
            <h1>Orders</h1>
            <a href="sections.php" class="continue">Continue Shopping</a>
        </div>
        <div class="cart">
<!--    <ul class="tableHead">
      <li class="prodHeader">Product</li>
      <li>Quantity</li>
      <li>Total</li>
       <li>Remove</li>
    </ul>-->
            <ul class="cartWrap">
                <?php
                    displayOrders($user_data, $con);
                ?>
            </ul>
        </div>
  
  <!--<div class="promoCode"><label for="promo">Have A Promo Code?</label><input type="text" name="promo" placholder="Enter Code" />
  <a href="#" class="btn"></a></div>-->
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    </body>
</html>
