<?php

include ('crud.php');

if($obj->isLogin() == false) { header('Location: index.php'); }

if (isset($_POST['submit'])) {
    if (($_POST['amount'] !="") && ($_POST['card_number'] !="") && ($_POST['e_date'] !="") && ($_POST['cvv']) !="") {
        $user_id = $_SESSION['user_id'];
        $amount =mysqli_real_escape_string($obj->connect, $_POST['amount']);
        $card =mysqli_real_escape_string($obj->connect,$_POST['card_number']);
        $date = mysqli_real_escape_string($obj->connect,$_POST['e_date']);
        $cvv = mysqli_real_escape_string($obj->connect,$_POST['cvv']);
        $save_card = $_POST['save_card'];
            if ($save_card ==1) $save_card='1'; else $save_card='0';

        $sql="insert into wallet set amount='$amount',card_number='$card',e_date='$date',cvv=$cvv,save_card=$save_card,user_id=$user_id";
        $query = $obj->execute_query($sql);
        if($query) {
            header('Location:wallet.php');
        } else {
            die(mysqli_error($obj->connect));
        }


        } else{
        $message = "Any of this field cannot be empty";
    }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/boot-css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="photos/logo.png" sizes="16x16">
      <link rel="stylesheet" href="css/fundWallet.css">
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
         	<a href="#"><img src="photos/basket.png" class="img img-responsive basket"></a>

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
                     <a href="#" id="profile">Profile</a>
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
                                <a href="order-history.php" class="history">Order History</a>
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

        <section>

            <!-- Side bar -->
            <div id="mySidenav" class="sidenav">
                <span><img src="photos/profile-image2.png" alt="profile image" class="img img-responsive profile-image" id="profileImage" style="position:absolute; margin-left: 30px"></span>
                <div style="font-size: 12px; margin-left: 80px; padding-bottom: 50px;">Hi user,<p>Email@email.com</p></div>

                <a href="personal-info.php"><span id="userInfo">Personal information</span></a>
                <a href="saved-card.php"><span>Saved Cards</span></a>
                <a href="wallet.php"><span id="wallet">Wallets</span></a>
                <a href="order-history.php"><span>Order History</span></a>
                <a href="settings.php"><span id="settings">Settings</span></a>

                <a href="Logout.php"><p class="logout">Logout</p></a>
            </div>
        </section>

        </div>
    </div>

    <div class="row">
            <div class="col-md-4">
        
            </div>
        <div class="col-md-8">
                <a href="javascript:void(0)" class="backbtn" onclick="goBack()">&#11013;</a>
            
             <!-- Wallet content begins here -->
            <div class="row">
                    <h4 class="fundYourWallet">Fund Your Wallet</h4>
                <div class="col-md-9 col-md-offset-2">
                    <div id="walletContainer">
                        <h4>Card</h4>
                        <hr>
                        <form action="fund-wallet.php" method="post">
                            <div class="form-group">
                                <div class="col-sm-12">
                                <input type="text" name="amount" class="form-control" id="amount" pattern="[0-9]*" placeholder="Amount">
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <input type="text" name="card_number" class="form-control" id="card_number" pattern="[0-9]*" maxlength="16" placeholder="0000-0000-0000-0000">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-5">
                                <input type="date" name="e_date" class="form-control" id="e_date" placeholder="04/08/2019">
                              </div>
                              <div class="col-sm-5 col-sm-offset-2">
                                <input type="text" name="cvv" class="form-control" id="cvv" pattern="[0-9]*"  maxlength="3" placeholder="CVV">
                              </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="save_card" value="1" id="save_card">Save Card details for Future Use</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="submit" class="btn btn-success" name="submit" id="submit" value="Credit Now">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Wallet content ends here -->
        </div>
    </div>
    
</div>

<footer class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
               <p>© Copyright 2018</p> <p class="footer-order">Ordermeals Powered by Tep Ventures</p>
            </div>
        </div>
</footer>

    <script src="js/boot-js/jquery.min.js"></script>
    <script src="js/boot-js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/load_data.js"></script>
    <script src="js/user.js"></script>
</body>
</html>