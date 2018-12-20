<?php

include ('crud.php');

if($obj->isLogin() == false) { header('Location: index.php'); }
//?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/boot-css/bootstrap.min.css">
    <link rel="stylesheet" href="css/settings.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <title>Order meals</title>


</head>
<body>
    <header>
        <div class="desktop-nav">
            <nav class="navbar  navbar-fixed-top mynav">
                <div class="navbar-logo"><a class="navbar-brand" href="user.php"><img src="photos/Logo.png" class="img img-responsive"></a></div>
         	<a href="#"><img src="photos/profile-image.png" class="img img-responsive profile-image"></a>
         	<a href="#"><img src="photos/basket.png" class="img img-responsive basket"></a>
                <a href="#feedback"><span>Feedback</span></a>
                <a href="menu.php"><span>Place your order</span></a>
            </nav>
        </div>

    <!-- Mobile navigation bar content-->
        <span class="navbar-header"><a class="navbar-brand" href="#"><img src="photos/Logo.png" class="img img-responsive logo"></a></span>
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
            
        <section>

            <!-- Side bar -->
            <div id="mySidenav" class="sidenav">
                <span><img src="photos/profile-image2.png" alt="profile image" class="img img-responsive profile-image" id="profileImage" style="position:absolute; margin-left: 30px"></span>
                <div style="font-size: 12px; margin-left: 80px; padding-bottom: 50px;">Hi user,

                    <p>
                            <?php
                                $user = $obj->get_fulldetails($_SESSION['email']);
                                echo $user['email'];
                            ?>
                    </p>
                </div>
                
                <a href="personal-info.php"><span id="userInfo">Personal information</span></a>
                <a href="saved-card.php"><span id="savedCard">Saved Cards</span></a>
                <a href="wallet.php"><span id="wallet">Wallets</span></a>
                <a href="#"><span id="history">Order History</span></a>
                <a href="settings.php"><span id="settings">Settings</span></a>
                
                <a href="Logout.php"><p class="logout">Logout</p></a>
            </div>
        </section>
    
        </div>
    </div>

    <div class="row">
        <div class="col-xs-0 col-md-4">
    
        </div>
        <div class="col-xs-12 col-md-8">
                <a href="javascript:void(0)" class="backbtn" onclick="goBack()">&#11013;</a>
            
             <!-- Settings content begins here -->
            <div id="settingsContent">
                <div class="userSettings">
                    <span class="profile-settings"><img src="photos/profile-image2.png" alt="" class="img img-responsive"><a href="profile-settings.php">Edit profile</a></span>
                    <span class="Password-settings"><img src="photos/lock.png" alt=""><a href="password-settings.php" class="img img-responsive">Password settings</a></span>
                </div>
            </div>
            <!-- Settings content ends here -->
            
        </div>
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