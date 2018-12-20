<?php

include ('crud.php');

if($obj->isLogin() == false) { header('Location: index.php'); }

if($obj->isAdminLogin() == false) { die("Unauthorized Page"); }

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/boot-css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="photos/logo.png" sizes="16x16">
      <link rel="stylesheet" href="css/dashboardProfile-settings.css">
      <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <title>Order meals</title>

      
    <script src="user.js"></script>

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

    <!-- Mobile navigation bar content-->
        <!-- <span class="navbar-header"><a class="navbar-brand" href="user.html"><img src="photos/Logo.png" class="img img-responsive logo"></a></span> -->
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
                      <a href="#">Profile</a>
                 </li>
                 <li>
                     <a href="dashboard.php">Dashboard</a>
                 </li>
                <li>
                    <a href="dashboard-menu.php">Settings</a>
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
        <div class="col-sm-12 -md-12">
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
                <a href="dashboard-settings.php"><span id="settings">Settings</span></a>
                
                <a href="Logout.php"><p class="logout">Logout</p></a>
            </div>
            <!-- Side bar ends -->
        </section>
    
        </div>
    </div>

    <div class="row">
                 <!--Edit profile begins here -->

                 <div class="row">
                        <div class="col-xs-12 col-md-7 col-md-offset-3">
                            <a href="javascript:void(0)" class="backbtn" onclick="goBack()">&#11013;</a>
                            
                            <!-- Profile settings begins here -->
                            <div id="profileSettingsContainer">
                                <form class="form-horizontal" action="dashboard-profile-settings.php" method="post">
                                    <h5 class="text-center"><?php if(isset($message)) echo $message; else echo ""; ?></h5>
                                        <span><img src="photos/profile-image.png" alt="profile image" class="img img-responsive profile-image" id="profileImage" style="margin: -20px 0 0 0; width: 60px"></span>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default set-a-pic">Set a Picture</button>
                                            
                                            </div>
                                        </div>
                                    <div class="form-group">
                                      <label for="inputFistname" class="col-sm-2">First Name</label>
                                      <div class="col-sm-7">
                                        <input type="text" class="form-control" name="firstname" value="<?php echo $user['firstname']; ?>" placeholder="First Name">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputLastname" class="col-sm-2 ">Lastname</label>
                                      <div class="col-sm-7">
                                        <input type="text" class="form-control" name="lastname" value="<?php echo $user['lastname']; ?>" placeholder="Last Name">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputLastname" class="col-sm-2">Phone Number</label>
                                        <div class="col-sm-7">
                                        <input type="text" class="form-control" name="phone" value="<?php echo $user['phone']; ?>" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2">Department</label>
                                        <div class="col-sm-7">
                                        <input type="text" class="form-control" name="dept" value="<?php echo $user['address']; ?>" placeholder="Department">
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
                <!-- Edit profile ends here -->
                
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