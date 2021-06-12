<?php
	include("connection.php");
	include("functions.php");
    
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		/** CAN'T ENTER ' IN THE STRING */
		$product_name =  strval($_POST['productName']);
		$product_section = strval($_POST['productSection']);
		$price = (int)$_POST['productPrice'];
        $product_description = strval($_POST['productDescription']);
        $product_amount = (int)$_POST['productAmount'];
        $img_link = strval($_POST['imgLink']);

		if(!empty($product_name) && !empty($product_section) && !empty($price)) {
			$query = "INSERT INTO products (product_name, product_section, product_description, img_link, product_amount, price) 
                        VALUES ('$product_name', '$product_section', '$product_description', '$img_link', $product_amount, $price);";

			pg_query($con, $query);
			header('Location: ../profile.php');
			die;
		}
			
	}
?>