<?php

include ('crud.php');

if($obj->isLogin() == false) { header('Location: index.php'); }

if($obj->isAdminLogin() == false) { die("Unauthorized Page"); }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/boot-css/bootstrap.min.css">
      <link rel="icon" type="image/png" href="photos/logo.png" sizes="16x16">
      <link rel="stylesheet" href="css/dashboard-settings.css">
      <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <title>Order meals</title>

</head>
<body>
    <header>
        <div class="desktop-nav">
            <nav class="navbar  navbar-fixed-top mynav">
                    <a href="#feedback"><span>Welcome, 
                            <?php
                            $user = $obj->get_fulldetails($_SESSION['email']);
                            echo $user['firstname']." ".$user['lastname'];
                            ?>
                        </span></a>
         	<a href="dashboard-profile.php"><img src="photos/admin-image.png" class="img img-responsive admin-image"></a>
         	<a href="#"><img src="photos/admin-note.png" class="img img-responsive admin-note"><span id="noteNum" style="display: block;">
                    <?php
                    $cnt = mysqli_num_rows(mysqli_query($obj->connect,"SELECT * FROM orders WHERE status=0"));
                    if ($cnt==0) echo ""; else echo $cnt;
                    ?>
                </span></a>
            </nav>
        </div>

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
                      <a href="dashboard-profile.php">Profile</a>
                 </li>
                 <li>
                     <a href="dashboard.php">Dashboard</a>
                 </li>
                <li>
                    <a href="dashboard-menu.php">Menu Settings</a>
                </li>
                 <li>
                     <a href="dashboard-settings.php">Settings</a>
                 </li>
                 <li>
                     <a href="Logout.php">Logout</a>
                 </li>
            </ul>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
            <section>
                <!-- Side bar -->
                <div id="mySidenav" class="sidenav">
                    <span class="admin-info">
                        <img src="photos/profile-image.png" alt="profile image" class="img img-responsive profile-image" id="profileImage" style="position:relative; margin-left: 0px">
                        <p>
                            <?php
                            $user = $obj->get_fulldetails($_SESSION['email']);
                            echo $user['firstname']." ".$user['lastname'];
                            ?>
                            <br><b>Role</b>
                        </p>
                    </span>
                    
                    <a href="dashboard.php"><span id="dashboard">Dashboard</span></a>
                    <a href="dashboard-menu.php"><span id="dashboardMenuSettings">Menu Settings</span></a>
                    <a href="dashboard-settings.php"><span id="dashboardSettings">Settings</span></a>
                    
                    <a href="Logout.php"><p class="logout">Logout</p></a>
                </div>
                <!-- Side bar ends -->
            </section>
        
            </div>
        </div>

    <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-3">
                    <a href="javascript:void(0)" class="backbtn" onclick="goBack()">&#11013;</a>
                
                 <!-- Settings content begins here -->
                <div id="DashboardSettingsContent">
                    <div class="userSettings">
                        <span class="dashboardProfile-settings"><img src="photos/profile-image2.png" alt="" class="img img-responsive"><a href="dashboard-profile-settings.php">Edit profile</a></span>
                        <span class="dashboardPassword-settings"><img src="photos/lock.png" alt=""><a href="dashboard-password-settings.php" class="img img-responsive">Password settings</a></span>
                    </div>
                </div>
                <!-- Settings content ends here -->
                
            </div>
    </div>
            <!-- Dashboard-settings information ends here -->


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