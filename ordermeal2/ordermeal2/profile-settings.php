<?php

include ('crud.php');

if($obj->isLogin() == false) { header('Location: index.php'); }

if (isset($_POST['submit'])) {
    $email = $_SESSION['email'];
    if (($_POST['firstname']== "") || ($_POST['lastname'] =="") || ($_POST['phone'])=="" || ($_POST['dept'])=="") {
        $message = "<span class='text-danger'>Any of this field cannot be empty</span>";
    } else {

        $firstname = mysqli_real_escape_string($obj->connect, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($obj->connect,$_POST['lastname']);
        $phone = mysqli_real_escape_string($obj->connect,$_POST['phone']);
        $dept = mysqli_real_escape_string($obj->connect,$_POST['dept']);

            $sql = $obj->execute_query("UPDATE user SET firstname='$firstname',lastname='$lastname',phone='$phone',address='$dept' where email='$email'");

            if ($sql) {
                $message = "<span class='text-success'>Profile successfully changed</span>";
            } else {
                $message = "<span class='text-danger'>Oops, There seems to be server issues, try again later</span>";
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
    <link rel="stylesheet" href="css/profileSettings.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

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
            
            <!-- Profile settings begins here -->
            <div id="profileSettingsContainer">
                <form class="form-horizontal" action="profile-settings.php" method="post">
                    <h4 class="text-center"><?php if(isset($message)) echo $message; else echo ""; ?></h4>
                    <span><img src="photos/profile-image.png" alt="profile image" class="img img-responsive profile-image" id="profileImage" style="position:absolute; margin: -20px 0 0 0; width: 60px"></span>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default set-a-pic">Set a Picture</button>
                            </div>
                        </div>
                    <div class="form-group">
                      <label for="inputFistname" class="col-sm-2">First Name</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" placeholder="First Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputLastname" class="col-sm-2 ">Lastname</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLastname" class="col-sm-2">Phone Number</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>" placeholder="Phone number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDepartment" class="col-sm-2">Department</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="dept" name="dept" value="<?php echo $user['address']; ?> " placeholder="Department">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-default">Update Settings</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--Profile settings ends here -->

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