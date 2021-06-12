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
    <title>Choose a section</title>

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
    <link rel="stylesheet" href="css/landing.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/text.css">
    <link href="css/sections.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
<!--Navbar-->
<?php
  insert_nav('sections');
?>
<div class="content">
  <a class="card" href="AmericanSweets.php">
    <div class="front" style="background-image: url(https://cdn.shopify.com/s/files/1/1002/6470/products/HeavenlySweets-Americanchocolatehamperandgifts-Main-2021_1024x1024.png?v=1619703461)">
      <p>American Sweets</p>
    </div>
    <div class="back">
      <div>
        <p>Consectetur adipisicing elit. Possimus, praesentium?</p>
        <p>Provident consectetur natus voluptatem quis tenetur sed beatae eius sint.</p>
        <button class="button">Click Here</button>
      </div>
    </div>
</a>
<a class="card" href="AmericanSnacks.php">
    <div class="front" style="background-image: url(https://images-na.ssl-images-amazon.com/images/I/91Io%2BMfhEFL._SL1500_.jpg)">
      <p>American snacks</p>
    </div>
    <div class="back">
      <div>
        <p>Consectetur adipisicing elit. Possimus, praesentium?</p>
        <p>Provident consectetur natus voluptatem quis tenetur sed beatae eius sint.</p>
        <button class="button">Click Here</button>
      </div>
    </div></a><a class="card" href="JapaneseSweets.php">
    <div class="front" style="background-image: url(https://store.gogonihon.com/wp-content/uploads/2020/05/japan-candy-box.png)">
      <p>Japanese sweets</p>
    </div>
    <div class="back">
      <div>
        <p>Consectetur adipisicing elit. Possimus, praesentium?</p>
        <p>Provident consectetur natus voluptatem quis tenetur sed beatae eius sint.</p>
        <button class="button">Click Here</button>
      </div>
    </div></a>
    <a class="card" href="Japanese.php">
    <div class="front" style="background-image: url(https://images-na.ssl-images-amazon.com/images/I/91icuxBvFsL._SL1500_.jpg)">
      <p>Japanese snacks</p>
    </div>
    <div class="back">
      <div>
        <p>Products straight from the land of Japan!</p>
        <p>Hard to find items right here</p>
        <button href="Japanese.php" class="button">Click Here</button>
      </div>
    </div></a>
    <a class="card" href="EuropeanSweets.php">
    <div class="front" style="background-image: url(https://cdn.shopify.com/s/files/1/0271/0955/6326/files/socials_JRP_200527_008_1000x1000.jpg?v=1609605459)">
      <p>European Sweets</p>
    </div>
    <div class="back">
      <div>
        <p>Consectetur adipisicing elit. Possimus, praesentium?</p>
        <p>Provident consectetur natus voluptatem quis tenetur sed beatae eius sint.</p>
        <button class="button">Click Here</button>
      </div>
    </div></a><a class="card" href="EuropeanSnacks.php">
    <div class="front" style="background-image: url(https://images-na.ssl-images-amazon.com/images/I/81B6J5%2BT%2BGL._AC_SL1500_.jpg)">
      <p>European Snacks</p>
    </div>
    <div class="back">
      <div>
        <p>Consectetur adipisicing elit. Possimus, praesentium?</p>
        <p>Provident consectetur natus voluptatem quis tenetur sed beatae eius sint.</p>
        <button class="button">Click Here</button>
      </div>
    </div></a>
</div>
<!--Scripts-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  </body>
</html>