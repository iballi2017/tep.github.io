<?php

include ('crud.php');

if($obj->isLogin() == false) { header('Location: index.php'); }

if (isset($_GET['action'])) {
    if ($_GET['action'] =='delete') {
        foreach ($_SESSION['cart'] as $keys => $value) {
            if ($value['meal_id'] == $_GET['id']) {
                unset($_SESSION['cart'][$keys]);
                echo '<script>alert("Product has been Remove...!")</script>';
                echo '<script>window.location="cart-view.php"</script>';


            }
        }
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
    <link rel="stylesheet" href="css/checkout.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <title>Order meals</title>

</head>
<body>
    <header>
        <div class="desktop-nav">
            <nav class="navbar  navbar-fixed-top mynav">
                <div class="navbar-logo"><a class="navbar-brand" href="user.php"><img src="photos/Logo.png" class="img img-responsive"></a></div>
         	<a href="#"><img src="photos/profile-image.png" class="img img-responsive profile-image"></a>
         	<a href="#"><img src="photos/basket.png" class="img img-responsive basket">
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
                                <a href="index.blade.php" class="signup">Logout</a>
                            </li>
                      </ul>
                 </li>
            </ul>
        </div>
    </header>
    <div class="container">
    <div class="row">
        <div class="col-md-12">

                <?php
                    $user = $obj->get_fulldetails($_SESSION['email']);
                ?>
        <section>

            <!-- Side bar -->
            <div id="leftSide" class="leftSide">
                <h2 class="header">Checkout</h2>
                <h4>Delivery details</h4>
                <p><span class="name"><b><?php echo $user['firstname'] . " ". $user['lastname'];  ?></b></span> <span class="email"><b><?php echo $user['email']; ?></b></span></p>
                <p class="department"><b><?php echo $user['address']; ?></b></p>
                <hr>
                <h4 class="paymentDetails">Payment details</h4>

                <!-- Payment with card option begins here -->
                <p><input type="checkbox" id="cardOptionClick"> Pay With Card</p>

                <form class="form-horizontal" role="form" action="" id="cardInfo">
                    <div class="form-group">
                        <label for="firstname" class="col-sm-8">Name On Card</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="firstname1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-8">Card Number</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="lastname1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="lastname" class="col-sm-8">Expiry Date</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="expiry">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname" class="col-sm-8">CVV</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="cvv">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <div class="checkbox">
                                <label><input type="checkbox">Save card for my future purchase</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Pay Now</button>
                        </div>
                    </div>
                </form>

                    <!-- Payment with wallet option begins here -->
                    <p><input type="checkbox" id="walletOptionClick"> Pay With Your Wallet</p>
                    <form id="walletInfo">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Banlance</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>#0</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Amount Charged</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>- #0</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5><strong>Current Balance</strong></h5>
                                </div>
                                <div class="col-md-6">
                                    <h5><strong>#0</strong></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">Pay Now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </form>

                    <!-- Payment with wallet option ends here -->

                <!-- Payment with Bank transfer option begins here -->
                <p><input type="checkbox" id="transferOptionClick">Bank transfer</p>

                <form class="form-horizontal" role="form" action="" id="transferInfo">
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <h5><strong>Ordermeals Nigeria</strong></h5>
                                <h5><strong>Account number: </strong>1122334455</p></h5>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-8">Teller</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="firstname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-8">Amount</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="lastname">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Pay Now</button>
                        </div>
                    </div>
                </form>
                <!-- Payment with Bank transfer option ends here -->
                <div class="mobileCheckoutSummary">
                    <span class="mobileSummary">Summary</span>
                </div>
        </section>
    
        </div>
    </div>

    <div class="row">
        <div class="col-xs-0 col-md-6">
    
        </div>
        <div class="col-xs-12 col-md-6">
                <a href="javascript:void(0)" class="backbtn" onclick="goBack()">&#11013;</a>
            
            <!-- Checkout content begins here -->
            <div id="orderSummary">
                    <div class="summary">
                        <h4>Your Order Summary</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>

                                    <?php
                                    $total = 0;
                                        if (!empty($_SESSION['cart'])) {

                                            foreach ($_SESSION['cart'] as $key => $value) {

                                                ?>
                                                <tr>
                                                    <td><span><img src="photos/<?php echo $value['meal_picture']; ?>"
                                                                   class="img img-responsive"></span><span><?php echo $value['meal_name']; ?></span>
                                                    </td>
                                                    <td><?php echo $value['meal_quantity']; ?></td>
                                                    <td>₦ <?php echo $value['meal_price']; ?></td>
                                                    <td>₦ <?php echo number_format($value['meal_quantity'] * $value['meal_price'], 2); ?></td>

                                                </tr>
                                                <?php
                                                $total = $total + ($value['meal_quantity'] * $value['meal_price']);
                                            }

                                    ?>

                                        <tr> 
                                            <td>Shipping</td> 
                                            <td></td> 
                                            <td></td>
                                            <td>₦ 0</td>
                                            <td></td>
                                        </tr> 
                                        <tr class="total"> 
                                            <td>Total</td> 
                                            <td></td> 
                                            <td></td>
                                            <td>₦ <?php echo number_format($total, 2); ?></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                        } else { echo '<b class="text-danger">No meal Available in cart</b><br><br>'; }
                                    ?>
                                    </tbody> 
                                </table> 
                            </div>
                            <div class="mobileCheckoutSummary">
<!--                                <span class="mobileCheckout">Checkout</span>-->
                            </div>
                        
                    </div>
                </div>
            <!-- Checkout content ends here -->
            
        </div>
    </div>
    
</div>

    <script src="js/boot-js/jquery.min.js"></script>
    <script src="js/boot-js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/load_data.js"></script>

    <script src="js/user.js"></script>
</body>
</html>