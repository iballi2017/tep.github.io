<?php

include ('crud.php');

if($obj->isLogin() == false) { header('Location: index.php'); }

if (isset($_POST['add'])) {
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], 'meal_id');
        if(!in_array($_GET['id'], $item_array_id)) {
            $count = count($_SESSION['cart']);
            $item_array = array (
                'meal_id'       => $_GET['id'],
                'meal_name'     => $_POST['hidden_name'],
                'meal_price'    => $_POST['hidden_price'],
                'meal_picture'    => $_POST['hidden_picture'],
                'meal_quantity' => $_POST['meal_quantity'],
            );
            $_SESSION['cart'][$_GET['id']] = $item_array;
            echo '<script>window.location="menu.php"</script>';

        } else {
            echo '<script>alert("Product is already Added to Cart")</script>';
            echo '<script>window.location="menu.php"</script>';
        }



    } else {
        $item_array = array(
            'meal_id'       => $_GET['id'],
            'meal_name'     => $_POST['hidden_name'],
            'meal_price'    => $_POST['hidden_price'],
            'meal_quantity' => $_POST['meal_quantity'],
        );
        $_SESSION['cart'][$_GET['id']] = $item_array;
    }
}

//?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/boot-css/bootstrap.min.css">
    <link rel="stylesheet" href="css/menu.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <style> .img_self { height: 200px; width: 500px;}</style>

    <title>Order meals</title>


</head>
<body>
    <header>
        <div class="desktop-nav">
            <nav class="navbar  navbar-fixed-top mynav">
                <div class="navbar-logo"><a class="navbar-brand" href="user.php"><img src="photos/Logo.png" class="img img-responsive"></a></div>
         	<a href="personal-info.php"><img src="photos/profile-image.png" class="img img-responsive profile-image"></a>
                <a href="cart-view.php"><img src="photos/basket.png" class="img img-responsive basket">
                    <span id="cartNum">
                        <?php
                        $cart_total = 0;
                            if (!empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    $cart_total = $cart_total + ($value['meal_quantity']);
                                }
                                 echo $cart_total;
                            }
                        ?>
                    </span>
                </a>
                <a href="#feedback"><span>Feedback</span></a>
                <a href="menu.php"><span>Place your order</span></a>
            </nav>
        </div>

    <!-- Mobile navigation bar content-->
        <span class="navbar-header"><a class="navbar-brand" href="user.php"><img src="photos/Logo.png" class="img img-responsive logo"></a></span>
        <div class="mobile-navbutton">
            <div class="cont" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
         <div class="mobile-nav-icons">
         	<a href="checkout.php"><img src="photos/basket.png" class="img img-responsive basket"></a>

         </div>
         <div class="mobile-nav">
            <ul class="nav nav-pills nav-stacked">
                 <li>
                      <a href="menu.php">Place Your Order</a>
                 </li>
                 <li>
                     <a href="#">Feedback</a>
                 </li>
                 <li>
                     <a href="user.php" id="profile">Profile</a>
                     <ul class="nav nav-pills nav-stacked" id="profileInfo" style="background: #ccc; display: none">
                            <li>
                                 <a href="personal-info.php">Personal Info</a>
                            </li>
                            <li>
                                <a href="saved-card.php">Saved Cards</a>
                            </li>
                            <li>
                                <a href="wallet.php" class="login">Wallet</a>
                            </li>
                            <li>
                                <a href="#" class="history">Order History</a>
                            </li>
                            <li>
                                <a href="settings.php" class="settings">Settings</a>
                            </li>
                            <li>
                                <a href="Logout.php" class="signup">Logout</a>
                            </li>
                      </ul>
                 </li>
            </ul>
        </div>
    </header>


    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12 hero">
                <div class="title">
                    <h1 class="heading">Menu</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
             <div class="col-xs-12 col-md-12">
                 <h2 class="breakfast-launch" id="order">Breakfast and Launch</h2>
                 <div class="hr"><hr></div>
            </div>
        </div>
        <div class="row">
            <?php
            $meal1 = $obj->get_all_Break_lunch_meals();

            foreach($meal1 as $breaklunch) {
            //breaking point
            ?>
            <form method="post" action="menu.php?action=add&id=<?php echo $breaklunch['meal_id']; ?>">
            <div class="col-xs-12 col-sm-3 col-md-3 food-row-1">
                <img src="photos/<?php echo $breaklunch['picture']; ?>" class="img img-responsive img-thumbnail img_self">
                <p class="caption"><?php echo $breaklunch['meal_name']; ?></p>
                <p class="price">₦ <?php echo $breaklunch['price']; ?></p>

                <input type="hidden" name="meal_quantity" value="1">
                <input type="hidden" name="hidden_name" value="<?php echo $breaklunch['meal_name']; ?>">
                <input type="hidden" name="hidden_price" value="<?php echo $breaklunch['price']; ?>">
                <input type="hidden" name="hidden_picture" value="<?php echo $breaklunch['picture']; ?>">

<!--                <a href="Cart.php" class="btn add-to-cart">ADD TO CART</a>-->

                <button class="btn add-to-cart" name="add">ADD TO CART</button>

            </div>
            </form>
                <?php
            }
            ?>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-12">
                <h2 class="salads-sandwiches">Salads and Sandwiches</h2>
                <div class="hr"><hr></div>
            </div>
        </div>
        <div class="row">
            <?php
            $meal = $obj->get_all_Sandwiches_meals();
            foreach($meal as $sandwich) {

                ?>
            <form method="post" action="menu.php?action=add&id=<?php echo $sandwich['meal_id']; ?>">
                <div class="col-xs-12 col-sm-3 col-md-3 food-row-1">
                    <img src="photos/<?php echo $sandwich['picture']; ?>" class="img img-responsive img-thumbnail img_self">
                    <p class="caption"><?php echo $sandwich['meal_name']; ?></p>
                    <p class="price">₦ <?php echo $sandwich['price']; ?></p>

                    <input type="hidden" name="meal_quantity" value="1">
                    <input type="hidden" name="hidden_name" value="<?php echo $sandwich['meal_name']; ?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $sandwich['price']; ?>">
                    <input type="hidden" name="hidden_picture" value="<?php echo $sandwich['picture']; ?>">

                    <button class="btn add-to-cart" name="add">ADD TO CART</button>
                </div>
            </form>
                <?php
            }
            ?>
        </div>
        <div class="row">
             <div class="col-xs-12 col-md-12">
                 <h2 class="breakfast-launch" id="order">Swallows</h2>
                 <div class="hr"><hr></div>
            </div>
        </div>

        <div class="row">

            <?php
            $meal = $obj->get_all_Swallows_meals();
            foreach($meal as $swallow) {

                ?>
            <form method="post" action="menu.php?action=add&id=<?php echo $swallow['meal_id']; ?>">
                <div class="col-xs-12 col-sm-3 col-md-3 food-row-1">
                    <img src="photos/<?php echo $swallow['picture']; ?>" class="img img-responsive img-thumbnail img_self">
                    <p class="caption"><?php echo $swallow['meal_name']; ?></p>
                    <p class="price">₦ <?php echo $swallow['price']; ?></p>

                    <input type="hidden" name="meal_quantity" value="1">
                    <input type="hidden" name="hidden_name" value="<?php echo $swallow['meal_name']; ?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $swallow['price']; ?>">
                    <input type="hidden" name="hidden_picture" value="<?php echo $swallow['picture']; ?>">

                    <button class="btn add-to-cart" name="add">ADD TO CART</button>
                </div>
            </form>
                <?php

            }
            ?>
        </div>
</div>
        <footer class="container">
            <div class="row">
                <div class="col-md-4">
                   <p>© Copyright 2018</p>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <p class="footer-order">Ordermeals Powered by Tep Ventures</p>
                </div>
            </div>
        </footer>

    <script src="js/boot-js/jquery.min.js"></script>
    <script src="js/boot-js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/load_data.js"></script>

    <script src="js/user.js"></script>
</body>
</html>