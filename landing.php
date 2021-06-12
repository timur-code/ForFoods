<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForFoods</title>

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
</head>
<body>
    <!--Navbar-->
    <?php
        include("php/connection.php");
        include("php/functions.php");

        insert_nav('landing');
    ?>

    <!--PAGE-->
    <div class="landing">
        <!-- HEADER SECTION-->
        <div class="landing-header">
            <div class="header-text">
                <p class="big-text text-black no-select"><span class="brand-text">ForFoods</span> is the best place for you to find imported food products!</p>
            </div>
        </div>

        <!-- ABOUT SECTION-->
        <div class="landing-about">
            <div class="about-section">
                <div class="about-text no-select">
                    <p>#1 online shop of foreign products in Kazakhstan!</p>
                    <p>You won't find better!</p>
                </div>
    
                <div class="about-image" 
                style="background-image: url(bg/cash-register.jpg);">
                </div>
            </div>
            
            <div class="about-section-reverse">
                <div class="about-image"
                style="background-image: url(bg/jap-snacks.jpg);">
                </div>

                <div class="about-text no-select">
                    <p>Most reasonable prices!</p>
                    <p>Available to anyone!</p>
                </div>
            </div>

            <div class="about-section">
                <div class="about-text no-select">
                    <p>Wide selection of food</p>
                    <p>Will suit any taste!</p>
                </div>
                <div class="about-image" style="background-image: url(bg/cereal.webp);">
                </div>
            </div>
        </div>

        <!-- REVIEW SECTION-->
        <div class="landing-reviews">
            <p class="big-text center-text">What our customers think:</p>
            <div class="reviews-container">
                <div class="customer-card">
                    <img src="customers/harold1.jpg" alt="">
                    <p class="normal-text center-text">"The best service and great products!"</p>
                </div>
                <div class="customer-card">
                    <img src="customers/harold1.jpg" alt="">
                    <p class="normal-text center-text">"My grandkids love it!"</p>
                </div>
                <div class="customer-card">
                    <img src="customers/harold1.jpg" alt="">
                    <p class="normal-text center-text">"Awesome prices!"</p>
                </div>
            </div>
        </div>

        <!-- FOOTER SECTION-->
        <div class="landing-footer">
            <a class="big-text no-select" href="sign.php">Sign up now!</a>
        </div>
    </div>
    <!--Scripts-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>