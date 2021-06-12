<?php
	session_start();

	include("php/connection.php");
	include("php/functions.php");

	if(isset($_SESSION['user_id'])) {
		header("Location: profile.php");
		die;
	}

	//Logging functionality
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$login_email = $_POST['login_email'];
			$login_password = $_POST['login_password'];

			if(!empty($login_email) && !empty($login_password) 
				&& !is_numeric($login_email)) {
				//Check if user is in the DB
			
				$query = "SELECT * FROM users WHERE email = '$login_email' LIMIT 1";

				$result = pg_query($con, $query);

				if($result) {
					if($result && pg_num_rows($result) > 0) {
						$user_data = pg_fetch_assoc($result);

						if(password_verify($login_password, $user_data['pass_hash'])) {
							$_SESSION['user_id'] = $user_data['user_id'];
							header("Location: sections.php");
							die;
						}
						echo "<script type='text/javascript'>",
						"alert('Wrong password.');",
						"</script>";
						
					}
					else{
						echo "<script type='text/javascript'>",
						"alert('Wrong credentials.');",
						"</script>";
					}
				}			
			}
			else {
				echo "<script type='text/javascript'>",
							"alert('Empty fields.');",
							"</script>";
			}
			
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Sign in</title>

	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">

	<!--Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran&family=Courgette&family=Dancing+Script:wght@700&family=Lobster&family=Montserrat+Alternates:ital@1&display=swap" rel="stylesheet"> 

	<!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

	<!--Icons-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

	<!-- Own CSS -->
	<link href="css/sign.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/text.css">
</head>

<body>
    <!--Navbar-->
    <?php
		insert_nav('sign');
	?>

	<!-- Sign Form -->
	<div class="sign-container">
		<div class="form-structor">
			<form class="signup slide-up" method = "POST" action="php/signup.php">
				<h2 class="form-title" id="signup"><span>or</span>Sign up</h2>
				<div class="form-holder">
					<input type="text" class="input" placeholder="Name" name="user_name"/>
					<input type="email" class="input" placeholder="Email" name="user_email"/>
					<input type="password" class="input" placeholder="Password" name="password"/>
				</div>
				<button class="submit-btn" type="submit" value="Signup">Sign up</button>
			</form>
			<form class="login" method = "POST">
				<div class="center">
					<h2 class="form-title" id="login"><span>or</span>Log in</h2>
					<div class="form-holder">
						<input type="email" class="input" placeholder="Email" name="login_email"/>
						<input type="password" class="input" placeholder="Password" name="login_password"/>
					</div>
					<button class="submit-btn" type="submit" value="Login">Log in</button>
				</div>
			</form>
		</div>
	</div>	

	<!--Scripts-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
	<script src="js/sign.js"></script>
  	</body>
</html>
