<?php
    session_start();

    include("php/connection.php");
	include("php/functions.php");

    $user_data = check_login($con);

    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form'] == 'address') {
        $city = $_POST['city'];
        $street = $_POST['street'];
        $house = $_POST['house'];
        $apartment = $_POST['apartment'];
        $user_id = $user_data['user_id'];

        $query = "UPDATE users SET city = '$city', street = '$street', house = '$house', apartment = '$apartment' WHERE user_id = '$user_id'";

        pg_query($con, $query);

        header('Location: profile.php');
    }
    else if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        if(!empty($password1) && !empty($password2) && $password1 == $password2) {
            $pass_hash = password_hash($password1, PASSWORD_BCRYPT);
            $user_id = $user_data['user_id'];
            $query = "UPDATE users SET pass_hash='$pass_hash' WHERE user_id='$user_id'";

            pg_query($con, $query);

            header('Location: profile.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "".$user_data['name']."'s profile"; ?></title>
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
	<link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/text.css">
</head>
<body>
    <?php
        insert_nav('profile');
    ?>
    <div id="profileBody">
        <table class="table table-light table-striped">
            <tbody>
                <tr>
                    <th>
                        First Name
                    </th>
                    <td>
                        <?php
                            echo $user_data['name'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Last Name
                    </th>
                    <td>
                        Last Name
                    </td>
                </tr>
                <tr>
                    <th>
                        Email
                    </th>
                    <td>
                        <?php
                            echo $user_data['email'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        City
                    </th>
                    <td>
                        <?php
                            echo $user_data['city'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Street
                    </th>
                    <td>
                        <?php
                            echo $user_data['street'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        House
                    </th>
                    <td>
                        <?php
                            echo $user_data['house'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Apartment
                    </th>
                    <td>
                        <?php
                            echo $user_data['apartment'];
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="buttons">
            <a class="btn btn-success" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#passwordModal">
                Change Password
            </a>
            <?php
            if($user_data['email'] == 'timur@gmail.com') {
                echo    '<button type="button" class="btn btn-success" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#adminModal">
                            Add products
                        </button>';
            }
            ?>
            <button type="button" class="btn btn-success" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#addressModal">
                Add address
            </button>
        </div>
    </div>
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="newPassword1" class="col-form-label">New password:</label>
                        <input type="password" class="form-control" name="password1">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword2" class="col-form-label">Repeat new password:</label>
                        <input type="password" class="form-control" name="password2">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    </div>
                </form>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="adminModalLabel">Add new product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="php/addProduct.php">
                        <div class="mb-3">
                            <label for="productName" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" name="productName">
                        </div>
                        <div class="mb-3">
                            <label for="productSection" class="col-form-label">Section:</label>
                            <select class="form-select" name="productSection">
                                <option value="Japanese snacks">Japanese snacks</option>
                                <option value="Japanese sweets">Japanese sweets</option>
                                <option value="American snacks">American snacks</option>
                                <option value="American sweets">American sweets</option>
                                <option value="European snacks">European snacks</option>
                                <option value="European sweets">European sweets</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="col-form-label">Price(Integer):</label>
                            <input type="text" class="form-control" name="productPrice">
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="col-form-label">Description of the product:</label>
                            <textarea type="text" class="form-control" name="productDescription"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productAmount" class="col-form-label">Amount:</label>
                            <input type="text" class="form-control" name="productAmount">
                        </div>
                        <div class="mb-3">
                            <label for="imgLink" class="col-form-label">Link to image:</label>
                            <input type="text" class="form-control" name="imgLink">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">User's address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="form" value="address">
                        <div class="mb-3">
                            <label for="city" class="col-form-label">City:</label>
                            <select class="form-select" name="city">
                                <option value="Astana">Astana</option>
                                <option value="Almaty">Almaty</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="street" class="col-form-label">Street:</label>
                            <input type="text" class="form-control" name="street">
                        </div>
                        <div class="mb-3">
                            <label for="house" class="col-form-label">House:</label>
                            <input type="text" class="form-control" name="house"></input>
                        </div>
                        <div class="mb-3">
                            <label for="apartment" class="col-form-label">Apartment:</label>
                            <input type="text" class="form-control" name="apartment">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>