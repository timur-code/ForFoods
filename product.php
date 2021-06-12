<?php 
    session_start();

    include("php/connection.php");
	include("php/functions.php");

    $user_data = check_login($con);

	$product_id;
	$product;
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $product_id = $_GET['product_id'];
		$user_id = (int)$user_data['id'];
		$product = getProductData($product_id, $con);

		$liked="SELECT * FROM likes WHERE user_id = $user_id AND product_id = $product_id;";
		$likeResult = pg_query($con, $liked);
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form'] == 'cart') {
		$user_id = $user_data['id'];
		$amount = $_POST['amount'];
		$id = $_POST['product_id'];
		$section = $_POST['section'];

		$query="INSERT INTO cart (user_id, product_id, amount) VALUES ($user_id, $id, $amount);";
		$result = pg_query($con, $query);
		
		switch($section) {
			case "Japanese snacks":
				header("Location: Japanese.php");
				break;
			case "Japanese sweets":
				header("Location: JapaneseSweets.php");
				break;
			case "American sweets":
				header("Location: AmericanSweets.php");
				break;
			case "American snacks":
				header("Location: AmericanSnacks.php");
				break;
			case "European sweets":
				header("Location: EuropeanSweets.php");
				break;
			case "European snacks":
				header("Location: EuropeanSnacks.php");
				break;
		}
	}
	else if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form'] == 'like') {
		$product_id = (int)$_POST['product'];
		$user_id = (int)$user_data['id'];

		$liked="SELECT * FROM likes WHERE user_id = $user_id AND product_id = $product_id;";
		$likeResult = pg_query($con, $liked);
		if(pg_num_rows($likeResult) == 0) {
			$addLike = "INSERT INTO likes (user_id, product_id) VALUES ($user_id, $product_id);";
			pg_query($con, $addLike);

			$update = "UPDATE products SET likes = likes + 1 WHERE product_id = $product_id;";
			pg_query($con, $update);
		}
		else{
			$delLike = "DELETE FROM likes WHERE user_id = $user_id AND product_id = $product_id;";
			pg_query($con, $delLike);

			$update = "UPDATE products SET likes = likes - 1 WHERE product_id = $product_id;";
			pg_query($con, $update);
		}

		header('Location: product.php?product_id='.$product_id);
	}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $product['product_name']; ?></title>

    
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran&family=Courgette&family=Dancing+Script:wght@700&family=Lobster&family=Montserrat+Alternates:ital@1&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700,900" rel="stylesheet">
    
    <!--Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    
    <!--Own css-->
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/text.css">
    <link href="css/product.css" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <?php
        insert_nav('sections');
    ?>
    <section class="product">
	<div class="product__photo">
		<div class="photo-container">
			<div class="photo-main">
				<div class="controls">
					<form class="like-form" method = "POST">
						<button type="submit" class="like-btn <?php if(pg_num_rows($likeResult) > 0) echo "liked"; ?>">
							<i class="material-icons">favorite_border</i>
						</button>
						<input type="hidden" name="form" value="like"/>
						<input type="hidden" name="product" value="<?php echo $product_id ?>"/>
					</form>
				</div>
				<img src="<?php echo $product['img_link'];?>" alt="green apple slice">
			</div>
			<!--<div class="photo-album">
				<ul>
					<li><img src="https://res.cloudinary.com/john-mantas/image/upload/v1537302064/codepen/delicious-apples/green-apple2.png" alt="green apple"></li>
					<li><img src="https://res.cloudinary.com/john-mantas/image/upload/v1537303532/codepen/delicious-apples/half-apple.png" alt="half apple"></li>
					<li><img src="https://res.cloudinary.com/john-mantas/image/upload/v1537303160/codepen/delicious-apples/green-apple-flipped.png" alt="green apple"></li>
					<li><img src="https://res.cloudinary.com/john-mantas/image/upload/v1537303708/codepen/delicious-apples/apple-top.png" alt="apple top"></li>
				</ul>
			</div>-->
		</div>
	</div>
	<div class="product__info">
		<div class="title">
			<h1>
            <?php echo $product['product_name']; ?>
            </h1>
			<span>COD: <?php echo $product_id; ?></span>
		</div>
		<div class="price">
			<span><?php echo $product['price']; ?></span>
		</div>
		<div class="description">
			<!--<h3>BENEFITS</h3>
			<ul>
				<li>Apples are nutricious</li>
				<li>Apples may be good for weight loss</li>
				<li>Apples may be good for bone health</li>
				<li>They're linked to a lowest risk of diabetes</li>
			</ul>-->
            <?php echo $product['product_description']; ?>
			<?php
				if($product['likes'] > 0)
				echo '<p>
						'.$product["likes"].' customers liked this product.
					  </p>';
			?>
		</div>
		<form method="POST" style="align-self:flex-end;">
            <input style="height:100%; width:40px; font-size:1em; border-radius: 7px; text-align:center;" type="text" value=1 name="amount"> </input>
            <button class="buy--btn">ADD TO CART </button>
			<select style="display:none;" name="section">
            	<option value="<?php echo $product['product_section']; ?>" selected>
                </option>
            </select>
			<select style="display:none;" name="product_id">
            	<option value="<?php echo $product['product_id']; ?>" selected>
                </option>
            </select>
			<input type="hidden" name="form" value="cart"/>
        </form>
	</div>
</section>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    
  </body>
</html>