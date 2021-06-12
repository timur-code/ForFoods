<?php

    session_start();
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_id = (int)$_POST['product_id'];
        $user_id = $user_data['id'];
        $query = "DELETE FROM cart WHERE product_id = '$product_id' AND user_id = '$user_id'";

        pg_query($con, $query);
    }

    header("Location: ../cart.php")
?>