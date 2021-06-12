<?php
	session_start();

	include("php/connection.php");
	include("php/functions.php");

	$user_data = check_login($con);
  $section = 'European sweets';

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $user_data['id'];
    $product_id = $_POST['product_id'];
    $amount = $_POST['amount'];
    
    $query="INSERT INTO cart (user_id, product_id, amount) VALUES ('$user_id', '$product_id', $amount);";
    $result = pg_query($con, $query);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>European sweets</title>

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
    <link href="css/products.css" rel="stylesheet" type="text/css"/>
</head>
  <!--Navbar-->
<?php
  insert_nav('sections');
?>
  <body>
    <div class="container">
        <div class="row">
          <?php
              getProducts($section, $con);
          ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
  </body>
</html>