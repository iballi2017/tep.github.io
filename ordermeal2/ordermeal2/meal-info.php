<?php
include ('crud.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/boot-css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meal-Info.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

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
         	<a href="cart-view.php"><img src="photos/basket.png" class="img img-responsive basket"></a>

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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:void(0)" class="backbtn" onclick="goBack()">&#11013;</a>
            </div>
        </div>





        <div class="row main-content">
            <div class="col-md-9 meal-Image"">
                <img src="photos/fooddd.png">
            </div>
            <div class="col-md-3 order-input">
                <div class="row">
                <h4>Rice and Chicken</h4>
                </div>
                <div class="row">
                <h4>₦ <?php  ?></h4>
                </div>
                <div class="row">
                    <img src="photos">
                    <p>Select Quantity</p>
                    <input type="text" width="1" class="inputQty">
                    <?php
                    $meal = array();
                    $total = 0;
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $key => $value) {
                            echo $value['meal_name'];
                        }

                    }
                    ?>
                </div>
                <div class="row">
                    <form role="form">
                        <div class="form-group">
                            <label for="name">
                                <h4>Select Delivery Location<br>
                                (Department)</h4>
                            </label>
                            <select class="form-control" style="width: 150px">
                                <option>Admin</option>
                                <option>Tech</option>
                                <option>LEAR Nigeria</option>
                                <option>C.E.O</option>
                            </select>
                            <div class="checkbox">
                                <label><input type="checkbox" value="">Save as delivery location</label>
                            </div>
                            <button type="button" class="btn col-md-8">Place Order</button>
                        </div>
                </div>
            </div>
        </div>

    <script src="js/boot-js/jquery.min.js"></script>
    <script src="js/boot-js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/load_data.js"></script>

    <script src="js/user.js"></script>
</body>
</html>