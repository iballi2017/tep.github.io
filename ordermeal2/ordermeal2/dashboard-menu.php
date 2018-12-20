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
      <link rel="stylesheet" href="css/dashboardMenuSettings.css">
      <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <style>
        .sm-image {width: 40px; height: 30px; }
    </style>
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
        <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-2">
            
                <h1>General information</h1>
            <!-- Dashboard information begins here -->
            <?php

            $cnt = mysqli_num_rows(mysqli_query($obj->connect,"SELECT * FROM user"));
            $active_count = mysqli_num_rows(mysqli_query($obj->connect, "SELECT DISTINCT user_id FROM orders"));
            $active_order = mysqli_num_rows((mysqli_query($obj->connect, "SELECT order_date FROM orders WHERE date(order_date)='".date('Y-m-d')."'") ));
            ?>
            
            <div class="container mobileView-adminInfo">
                <span class="admin-info">
                    <img src="photos/profile-image.png" alt="profile image" class="img img-responsive profile-image" id="profileImage" style="position:relative; margin-left: 0px">
                    <p>Admin Name<br><b>Role</b></p>
                </span>
            </div>
            <div class="row" id="dashboardContainer">
                <div class="col-xs-3 col-xs-offset-1 col-sm-3 col-sm-offset-1 col-md-3 col-md-offset-1 dash-summary" id="regUsers">
                    <h2><?php echo $cnt; ?></h2>
                    <p><h5>Registered Users</h5></p>
                </div>
                <div class="col-xs-3 col-xs-offset-1 col-sm-3 col-sm-offset-1 col-md-3 col-md-offset-1 dash-summary" id="activeUsers">
                    <h2><?php echo $active_count; ?></h2>
                    <p><h5>Active Users</h5></p>
                </div>
                <div class="col-xs-3 col-xs-offset-1 col-sm-3 col-sm-offset-1 col-md-3 col-md-offset-1 dash-summary" id= "orderPlaced">
                    <h2><?php echo $active_order; ?></h2>
                    <p><h5>Order Placed Today</h5></p>
                </div>
            </div>
            <!-- Dashboard information ends here -->

            <!-- Dashboard2 information begins here -->
            <div class="row" id="dashboardContainer2">
                <div class="col-sm-12 col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                            <thead>
                              <tr>
                                <th>S/N</th>
                                <th>Categories</th>
                                <th>Meal</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="developers">
                            <?php
                                $sn = 0;
                            $get = $obj->execute_query("SELECT * FROM meals");
                            if (mysqli_num_rows($get) > 0) {
                                while ($get_row = mysqli_fetch_assoc($get)) {
                                    $sn+=1;
                                    ?>
                                    <tr>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $get_row['model']; ?></td>
                                        <td><?php echo $get_row['meal_name']; ?></td>
                                        <td><img src="photos/<?php echo $get_row['picture']; ?>"  class="img img-responsive img-circle sm-image"/></td>
                                        <td><?php echo $get_row['description']; ?></td>
                                        <td>₦ <?php echo $get_row['price']; ?></td>
                                        <td><?php echo $get_row['quantity']; ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                            <a href="dashboard-edit-item.php?meal_action=add&id=<?php echo$get_row['meal_id']; ?>" class="btn btn-warning btn-xs col-xs-10">Edit</a>
                                                </div>
                                                <div class="col-md-6">
                                            <form action="dashboard-edit-item.php" method="post">
                                                <input type="hidden" value="<?php echo $_SESSION['umeal']; ?>" name="meal_id">
                                                <button type="submit" name="delete" class="btn btn-danger btn-xs  delete" data-toggle="confirmation">Delete</button>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                              ?>
                            </tbody>
                        </table>
                    <div class="col-md-12 text-center">
                        <ul class="pagination pagination-lg pager" id="developer_page"></ul>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-10">
                    <a href="dashboard-add-new.php" class="btn btn-sm addItems">Add New Items</a>
                </div>
            </div>
            <!-- Dashboard2 ends here -->

        </div>
    </div>
    
</div>

    <script src="js/boot-js/jquery.min.js"></script>
    <script src="js/boot-js/bootstrap.min.js"></script>
    <script src="js/bootstrap-table-pagination.js"></script>
    <script src="js/pagination.js"></script>
    <script type="text/javascript" src="js/load_data.js"></script>
    <script src="js/user.js"></script>
    <script src="js/bootstrap-confirmation.min.js"></script>
    <script>
        console.log('Bootstrap ' + $.fn.tooltip.Constructor.VERSION);
        console.log('Bootstrap Confirmation ' + $.fn.confirmation.Constructor.VERSION);

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            container: 'body'
        });
        $('[data-toggle=confirmation-singleton]').confirmation({
            rootSelector: '[data-toggle=confirmation-singleton]',
            container: 'body'
        });
    </script>
</body>
</html>