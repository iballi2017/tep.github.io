<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="icon" type="image/png" href="photos/logo.png" sizes="16x16">
      <link rel="stylesheet" href="personalInfo.css">
      <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <title>Order meals</title>

      
    <script src="user.js"></script>

</head>
<body>
    <header>
        <div class="desktop-nav">
            <nav class="navbar  navbar-fixed-top mynav">
                <div class="navbar-logo"><a class="navbar-brand" href="user.html"><img src="photos/Logo.png" class="img img-responsive"></a></div>
         	<a href="#"><img src="photos/profile-image.png" class="img img-responsive profile-image"></a>
         	<a href="#"><img src="photos/basket.png" class="img img-responsive basket"></a>
                <a href="#feedback"><span>Feedback</span></a>
                <a href="menu.html"><span>Place your order</span></a>
            </nav>
        </div>

    <!-- Mobile navigation bar content-->
        <span class="navbar-header"><a class="navbar-brand" href="user.html"><img src="photos/Logo.png" class="img img-responsive logo"></a></span>
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
                      <a href="menu.html">Place Your Order</a>
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
                                <a href="savedCard.html">Saved Cards</a>
                            </li>
                            <li>
                                <a href="wallet.html" class="login">Wallet</a>
                            </li>
                            <li>
                                <a href="orderHistory.html" class="history">Order History</a>
                            </li>
                            <li>
                                <a href="settings.html" class="settings">Settings</a>
                            </li>
                            <li>
                                <a href="#S" class="">Logout</a>
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
                    <div class="name-email">Hi user,<p>Email@email.com</p></div>
                    
                    <a href="personalInfo.html"><span id="userInfo">Personal information</span></a>
                    <a href="savedCard.html"><span>Saved Cards</span></a>
                    <a href="wallet.html"><span id="wallet">Wallets</span></a>
                    <a href="orderHistory.html"><span id="settings">Order History</span></a>
                    <a href="settings.html"><span id="settings">Settings</span></a>
                    
                    <a href="index.html"><p class="logout">Logout</p></a>
                </div>
            </section>
        
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
        
            </div>
            <div class="col-md-8">
                    <a href="javascript:void(0)" class="backbtn" onclick="goBack()">&#11013;</a>
                <!-- Personal information content begins here -->
                <div id="personalInformationContent">
                    <div id="info">
                        <h4>Details</h4>
                        <p><b>Name:</b> Bukunmi Folorunsho</p>
                        <p><b>E-mail address:</b> bukunmifolorunsho@gmail.com</p>
                        <div id="delivery">
                            <h4>Delivery (location)</h4>
                            <p><b>Admin:</b> <a href="#">Edit</a> </p>
                        </div>
                    </div>
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
</body>
</html>