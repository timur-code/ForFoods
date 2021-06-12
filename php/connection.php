<?php
    $con_string = "host=127.0.0.1 port=5432 dbname=ForFood user=postgres password=postgres";

    if(!$con = pg_connect($con_string)) {
        die("Failed to connect to DB.");
    }
    /*else {
        echo "<script> alert('Connected'); </script>";
    }*/
?>