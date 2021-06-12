<?php
    function check_login($con) {
        if(isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            $query = "SELECT * FROM users 
                WHERE user_id = '$id' LIMIT 1";

            $result = pg_query($con, $query);
            if($result && pg_num_rows($result) > 0) {
                $user_data = pg_fetch_assoc($result);
                return $user_data;
            }
        }

        //Redirect to Sign in page
        header("Location: sign.php");
        die;
    }

    function random_num($length) {
        $text = "";
        if($length < 5) {
            $length = 5;
        }

        $len = rand(4, $length);

        for ($i = 0; $i < $len; $i++) {
            $text .= rand(0,9);
        }

        return $text;
    }

    function insert_nav($name) {
        echo '<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="landing.php">ForFoods</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-5" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link '.(($name=='landing')?'active':'').'" aria-current="page" href="landing.php"><i class="bi bi-house"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link '.(($name=='sections' || $name == 'store')?'active':'').'" href="sections.php"><i class="bi bi-cart"></i> Store</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link '.(($name=='profile' || $name == 'sign')?'active':'').'" href="sign.php"><i class="bi bi-box-arrow-in-right"></i></i> Sign up</a>
                </li>
                </ul>
                <div class="d-flex flex-grow-1"></div>
                <div class="btn-group dropdown-menu-start">
                    <a class="nav-link text-light"  id="userProfile" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle"></i></a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person-circle"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="cart.php"><i class="bi bi-cart-fill"></i> Cart</a></li>
                        <li><a class="dropdown-item" href="orders.php"><i class="bi bi-cart-check"></i> History</a></li>
                        <li><a class="dropdown-item" href="php/logout.php"><i class="bi bi-box-arrow-left"></i> Log out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>';
    }

    function getProducts($section, $con) {
        $query = "SELECT product_name, product_section, product_description, img_link, price, product_id, likes FROM products WHERE product_section = '$section'";

        $result = pg_query($con, $query);

        $numProducts = pg_num_rows($result);

        switch($section){
            case "Japanese snacks":
                $section = "Japanese";
                break;
            case "Japanese sweets":
                $section = "JapaneseSweets";
                break;
            case "American snacks":
                $section = "AmericanSnacks";
                break;
            case "American sweets":
                $section = "AmericanSweets";
                break;
            case "European snacks":
                $section = "EuropeanSnacks";
                break;
            case "European sweets":
                $section = "EuropeanSweets";
                break;    
        }

        while($numProducts > 0) {
            $product = pg_fetch_row($result, $numProducts - 1);

            echo '<div class="col-md-12 col-lg-6">
            <!-- First product box start here-->
            <div class="prod-info-main prod-wrap clearfix">
                <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="product-image">
                    <img src="'.($product[3]).'" class="img-responsive img-zoom"> 
                                <span class="tag2 hot">
                                    HOT
                                </span> 
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="product-deatil">
                                <h5 class="name">
                                    <a href="#">
                                    '.($product[0]).'
                                    </a>
                                    <a href="'.($section).'.php">
                                        <span>'.($product[1]).'</span>
                                    </a>                            
        
                                </h5>
                                <p class="price-container">
                                    <span>'.($product[4]).'tg</span>
                                </p>
                                <span class="tag1"></span> 
                        </div>
                        <div class="description">
                            <p>'.($product[2]).'</p>';
                            if($product[6]>0) 
                            echo '<p>'.($product[6]).' customers liked this product.</p>';
                        echo '</div>
                        <div class="product-info smart-form">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <form method="POST" style="margin-bottom:10px;">
                                        <input style="height:100%; width:30px; font-size:1rem;" type="text" value=1 name="amount"> </input>
                                        <button class="btn btn-danger btn-cart" style="margin-left:5px"><span>Add to cart <i class="bi bi-cart-plus"></i></span></button>
                                        <select style="display:none;" name="product_id">
                                            <option value="'.($product[5]).'" selected>
                                            </option>
                                        </select>
                                    </form>
                                    <form  method="GET" action="product.php">
                                        <select style="display:none;" name="product_id">
                                            <option value="'.($product[5]).'" selected>
                                            </option>
                                        </select>
                                        <button type = "submit" class="btn btn-info"><span>More info <i class="bi bi-info-circle"></i></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end product -->
        </div>     ';

            $numProducts--;
        }
    }

    function admin_acc(){
        if($_SESSION['user_email'] == 'timur@gmail.com') {
            echo 'display: block;';
        }
    }

    function getProductData($product_id, $con) {
        $query = "SELECT product_name, product_section, product_description, img_link, price, product_id, likes FROM products WHERE product_id = '$product_id' LIMIT 1";

        $result = pg_query($con, $query);
        
        if($result && pg_num_rows($result) > 0) {
            $product = pg_fetch_assoc($result);
            return $product;
        }

        echo '<script> alert("Could not load the product data.") </script>';
        header("Location: sections.php");
        die;
    }

    function displayCart($user_data, $con) {
        $user_id = (int)$user_data['id'];
        $query = "SELECT products.product_name, products.img_link, cart.product_id, cart.amount, products.price, cart_id FROM cart 
            INNER JOIN products ON cart.product_id = products.product_id WHERE cart.user_id = '$user_id';";

        $result = pg_query($con, $query);

        $numProducts = pg_num_rows($result);

        // if($numProducts == 0) {
        //     die;
        // }

        $total = 0;
        $i = 0;
        $j = $numProducts;
        $product = array();
        while($j > 0) {
            $product[$i] = array();
            $product[$i] = pg_fetch_row($result, --$j);
            array_push($product[$i++], 0);
        }

        $k = $numProducts;
        for($i = 0; $i < $numProducts; $i++) {
            if(isset($product[$i])) {
                $product[$i][6] = (int)$product[$i][3] * (int)$product[$i][4];
                for($j = $i+1; $j < $numProducts; $j++) {
                    if(isset($product[$j])) {
                        if($product[$i][2] == $product[$j][2]) {
                            $product[$i][3] += $product[$j][3];
                            $product[$i][6] = (int)$product[$i][3] * (int)$product[$i][4];
                            unset($product[$j]);
                        }
                    }
                }
            }
        }

        $i = 0;
        $key = 0;
        $returnProduct = array();
        while ($i < $k) {
            if(isset($product[$i])) {
                echo    '<li class="items odd">
                            <div class="infoWrap"> 
                                <div class="cartSection">
                                    <img src="'.$product[$i][1].'" alt="" class="itemImg" />
                                    <p class="itemNumber">'.$product[$i][2].'</p>
                                    <h3>'.$product[$i][0].'</h3>
                                    
                                    <p> <input type="text" disabled class="qty" placeholder="'.$product[$i][3].'"/> x '.$product[$i][4].'</p>
                                    
                                    <p class="stockStatus"> In Stock</p>
                                </div>  
                            
                                <div class="prodTotal cartSection" style="
                                display: flex;
                                justify-content: flex-end;">
                                    <p>'.$product[$i][6].'</p>
                                </div>
                                <div class="cartSection removeWrap">
                                    <form method="POST" action="php/deleteFromCart.php" style="
                                    display: flex;
                                    justify-content: flex-end;">
                                        <button class="remove" value="'.$product[$i][2].'" name="product_id">x</button>
                                    </form>
                                </div>
                            </div>
                        </li>';
                $total += $product[$i][6];
                $returnProduct[$key++] = $product[$i];
            }
            $i++;
        }
        $returnProduct[] = $total;
        return $returnProduct;
    }

    function displayOrders($user_data, $con){
        $user_id = (int)$user_data['id'];
        $query = "SELECT products.product_name, products.img_link, products.price, orders.product_id, orders.amount, orders.total, orders.order_date  
            FROM orders INNER JOIN products ON orders.product_id = products.product_id WHERE orders.user_id = '$user_id' ORDER BY orders.order_date;";

        $result = pg_query($con, $query);
        $numProducts = pg_num_rows($result);

        // if($numProducts == 0) {
        //     die;
        // }

        $total = 0;
        $i = 0;
        $j = $numProducts;
        $product = array();
        while($j > 0) {
            $product[$i] = array();
            $product[$i++] = pg_fetch_row($result, --$j);
        }

        for($i = 0; $i < $numProducts; $i++) {
            echo    '<li class="items odd">
                            <div class="infoWrap"> 
                                <div class="cartSection">
                                    <img src="'.$product[$i][1].'" alt="" class="itemImg" />
                                    <p class="itemNumber">'.$product[$i][3].'</p>
                                    <h3>'.$product[$i][0].'</h3>
                                    
                                    <p> <input type="text" disabled class="qty" placeholder="'.$product[$i][4].'"/> x '.$product[$i][2].'</p>
                                    
                                    <p class="stockStatus"> '.$product[$i][6].'</p>
                                </div>  
                            
                                <div class="prodTotal cartSection" style="
                                display: flex;
                                justify-content: flex-end;
                            ">
                                    <p>'.$product[$i][5].'</p>
                                </div>
                            </div>
                        </li>';
        }
    }