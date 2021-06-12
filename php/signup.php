<?php
	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		//Sign up
		$user_name =  $_POST['user_name'];
		$user_email = $_POST['user_email'];
		$password = $_POST['password'];

			if(!empty($user_email) && !empty($user_name) && !empty($password) 
				&& !is_numeric($user_email) && !is_numeric($user_email)) {
				//Save user into MySQL DB
				$pass_hash = password_hash($password, PASSWORD_BCRYPT);
				$user_id = random_num(20);
				$query = "INSERT INTO users (user_id, email, name, pass_hash) 
					VALUES ('$user_id', '$user_email', '$user_name', '$pass_hash')";

				pg_query($con, $query);

				header("Location: ../sign.php");
				die;
			}
	}
?>