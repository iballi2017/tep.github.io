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
    <link rel="stylesheet" href="css/user.css">
      <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <title>Order meals</title>




</head>
<body>
    <header>
        <div class="desktop-nav">
            <nav class="navbar  navbar-fixed-top mynav">
                <div class="navbar-logo"><a class="navbar-brand" href="user.php"><img src="photos/Logo.png" class="img img-responsive"></a></div>
         	    <a href="personal-info.php"><img src="photos/profile-image.png" class="img img-responsive profile-image"></a>
         	    <a href="cart-view.php"><img src="photos/basket.png" class="img img-responsive basket"></a>
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
                                 <a href="#">Personal Info</a>
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
                                <a href="index.blade.php" class="signup">Logout</a>
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
                    <h1 class="heading">Order delicious food to your <br>desk</h1>
                    <h3><p class="tagline">Your quick food delivery service</p></h3>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <a href="menu.php" class="btn btn-success place-order-button">Place your order</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <h3 class="how-it-works">How it works</h3><div class="row">
                        </div>
                    </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="action-icon" id="choose">
                            <p class="figure">1.</p>
                            <img src="photos/Choosemeal.png" class="img">
                            <p class="caption">Choose a meal</p>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="action-icon" id="order">
                            <p class="figure">2.</p>
                            <img src="photos/Placeyourorder.png" class="img">
                             <p class="caption">Place your order</p>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="action-icon" id="deliver">
                            <p class="figure">3.</p>
                            <img src="photos/handlogo.png" id="handlogo" class="img">
                            <p class="caption">We deliver</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
             <div class="col-md-12">
                 <h2 class="most-popular">Most Popular</h2>
            </div>
        </div>
        
        <div class="row">
             <div class="col-xs-12 col-sm-3 col-md-3 food-row-1">
                 <img src="photos/Beans-and-Corn.png" class="img img-responsive">
                 <p class="caption">Beans and corn</p>
                 <p class="price">#150</p>
                 <button class="btn add-to-cart">ADD TO CART</button>
             </div>
             <div class="col-xs-12 col-sm-3 col-md-3 food-row-1">
                 <img src="photos/potato-and-fish.png" class="img img-responsive">
                 <p class="caption">Potato and fish</p>
                 <p class="price">#450</p>
                 <button class="btn add-to-cart">ADD TO CART</button>
             </div>
             <div class="col-xs-12 col-sm-3 col-md-3 food-row-1">
                 <img src="photos/Rice-and-spaghetti.png" class="img img-responsive">
                 <p class="caption">Rice and Rice-and-spaghetti</p>
                  <p class="price">#350</p>
                <button class="btn add-to-cart">ADD TO CART</button>
            </div>
             <div class="col-xs-12 col-sm-3 col-md-3 food-row-1">
                <img src="photos/Moi-moi-and-pap.png" class="img img-responsive">
                <p class="caption">Moi moi and pap</p>
                 <p class="price">#200</p>
                <button class="btn add-to-cart">ADD TO CART</button>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" id="myLoginModal" role="dialog">
                    <div class="modal-dialog">  
                                <!--Login Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Login here</h4>
                            </div>
                            <div class="modal-body" style="padding-left: -50px;">
                                    <div class="login-options">
                                        <h3>Welcome Back</h3>
                                        <p>Sign in and enjoy your favourite meal</p>
                                        <p>Sign in with social accounts</p>
                                    </div>
                                <form class="form-horizontal login-form" role="form" name="loginForm" action="" onsubmit="return(validate())" method="POST">
                                    <div class="form-group">
                                        <label for="firstname" class="col-sm-2" name="email">Email Address</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control inputarea" id="email" required>
                                            <!-- <div id="emailErrorMessage" style="color: red; font-size: 12px; display: none">Please provide your email address!</div> -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lasttname" class="col-sm-2" name="pwd">Password</label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control inputarea" id="pwd" required>
                                            <!-- <div id="pwdErrorMessage" style="color: red; font-size: 12px; display: none">Please provide your password!</div> -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn form-button">Sign in</button>
                                        </div>
                                        <span class="have-account">Dont't have an acccount?</span> <a href="#"><span class="signup">Sign Up</span></a>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Signup Modal content -->

        <div class="row">
            <div class="col-md-12">
                 <!-- Modal -->
                <div class="modal fade" id="mySignupModal" role="dialog">
                    <div class="modal-dialog">  
                                 <!-- signup Modal content-->
                        <div class="modal-content">
                                <div class="modal-header">
                                 <button type="button" class="close form-close" data-dismiss="modal">&times;</button>
                                 <h2 class="modal-title">Signup here</h2>
                             </div>
                            <div class="modal-body">
                                <form class="form-horizontal login-form" role="form">
                                   <div class="form-group">
                                        <label for="firstname" class="col-sm-2" name="firstname">Firstname</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control inputarea" id="firstname" name="firstname" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lasttname" class="col-sm-2" name="lastname">Lastname</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control inputarea" id="lastname" name="lastname" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <label for="email" class="col-sm-2" name="email">E-mail address</label>
                                           <div class="col-sm-6">
                                            <input type="text" class="form-control inputarea" id="email" name="email" required>
                                         </div>
                                    </div>
                                    <div class="form-group">
                                         <label for="email" class="col-sm-2" name="email">Password</label>
                                           <div class="col-sm-6">
                                            <input type="password" class="form-control inputarea" id="password" name="pwd" required>
                                         </div>
                                    </div>
                                    <div class="form-group">
                                         <label for="email" class="col-sm-2" name="email">Re-enter password</label>
                                           <div class="col-sm-6">
                                            <input type="password" class="form-control inputarea" id="rePwd" name="rePwd" required>
                                         </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="home" class="col-sm-2" name="home">Home Address</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control inputarea" id="lastname" required>
                                        </div>
                                     </div>
                                    <div class="form-group">
                                        <label for="phone" class="col-sm-2" name="phone">Phone number</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control inputarea" id="lastname" required>
                                         </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn form-button">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>           
                    </div>
                </div>
            </div>
        </div>

                <div class="row feedback-area">
                    <div class="col-md-12">
                            <h3 class="feedback-heading" id="feedback">Let us get your feedback so we can serve you better</h3>
                        <!-- <div class="feedback-container"> -->
                            <form class="form-horizontal e-message" role="form">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2">Name</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control inputarea" id="inputname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 label-email">Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control inputarea" id="inputemail">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message" class="col-sm-2">Message</label>
                                    <div class="col-sm-6">
                                    <textarea class="form-control textarea" rows="7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn form-button">Send</button>
                                    </div>
                                </div>
                            </form>
                        <!-- </div> -->
                </div>
            </div>
    </div>


    <footer class="container-fluid">
        <div class="row">
            <div class="col-md-12">
               <p>© Copyright 2018<br>
               <b class="footer-order">Ordermeals Powered by Tep Ventures</b> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </footer>

    <script src="js/boot-js/jquery.min.js"></script>
    <script src="js/boot-js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/load_data.js"></script>

    <script src="js/user.js"></script>
</body>
</html>