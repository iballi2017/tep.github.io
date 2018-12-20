<?php

include ('crud.php');

if($obj->isLogin() == false) { header('Location: index.php'); }
if($obj->isAdminLogin() == false) { die("Unauthorized Page"); }

if (isset($_POST['approve'])) {
    if (($_POST['order_id']== "") || ($_POST['approve'] =="")) {
        $id = $_POST['order_id'];
        $action = $_POST['approve_order'];

        $sql = $obj->approve_cancel_order($action, $id);
    }

}

if (isset($_POST['cancel'])) {
    if (($_POST['order_id']== "") || ($_POST['cancel'] =="")) {
        $id = $_POST['order_id'];
        $action = $_POST['cancel_order'];
        $sql = $obj->approve_cancel_order($action, $id);
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
      <link rel="stylesheet" href="css/dashboard.css">
      <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <title>Order meals</title>

</head>
<body>
    <header>
        <div class="desktop-nav">
            <nav class="navbar  navbar-fixed-top mynav">
                    <a href="#"><span> Welcome,
                            <?php
                            $user = $obj->get_fulldetails($_SESSION['email']);
                            echo $user['firstname']." ".$user['lastname'];
                            ?>
                        </span></a>
         	<a href="dashboard-profile.php"><img src="photos/admin-image.png" class="img img-responsive admin-image"></a>
         	<a href="dashboard.php"><img src="photos/admin-note.png" class="img img-responsive admin-note"><span id="noteNum" style="display: block;">
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
            
            <div class="container mobileView-adminInfo">
                <span class="admin-info">
                    <img src="photos/profile-image.png" alt="profile image" class="img img-responsive profile-image" id="profileImage" style="position:relative; margin-left: 0px">
                    <p>
                        <?php
                        $user = $obj->get_fulldetails($_SESSION['email']);
                        echo $user['firstname'];
                        ?>
                        <br><b>Role</b>
                    </p>
                </span>
            </div>
            <?php

                $cnt = mysqli_num_rows(mysqli_query($obj->connect,"SELECT * FROM user"));
                $active_count = mysqli_num_rows(mysqli_query($obj->connect, "SELECT DISTINCT user_id FROM orders"));
                $active_order = mysqli_num_rows((mysqli_query($obj->connect, "SELECT order_date FROM orders WHERE date(order_date)='".date('Y-m-d')."'") ));
            ?>
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
                    <h2><?php echo $active_order; ?> </h2>
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Food Ordered</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Delivery Office</th>
                                <th>Email Address</th>
                                <th class="action-column">Action</th>
                                <th class="action-column">Status</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                            $sn = 0;
                            $id = $_SESSION['user_id'];
                            $get = $obj->execute_query("SELECT * FROM user INNER JOIN orders ON user.user_id=orders.user_id ORDER BY order_id DESC ");
                            if (mysqli_num_rows($get) > 0) {

                                while ($get_row = mysqli_fetch_assoc($get)) {
                                    $sn+=1;
                            $get2 = $obj->execute_query("SELECT * FROM order_details where order_id=" . $get_row['order_id'] . "");
                            if (mysqli_num_rows($get2) > 0) {
                                $comma_dilimit = "";
                                while ($get_row2 = mysqli_fetch_assoc($get2)) {
                                    $comma_dilimit .= $get_row2['order_meal_name'] . ",";
                                }
                            }

                            ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $get_row['firstname'] . " " . $get_row['lastname']; ?></td>
                                <td><b><?php echo rtrim($comma_dilimit, ",") ?></b></td>
                                <td><?php echo $get_row['order_quantity']; ?></td>
                                <td>₦ <?php echo $get_row['order_total_price']; ?></td>
                                <td><?php echo $get_row['address']; ?></td>
                                <td><?php echo $get_row['email']; ?></td>
                                <td>
                                    <form action="dashboard.php" method="post" id="myForm">
                                        <input type="hidden" name="order_id"
                                               value="<?php echo $get_row['order_id']; ?>">
                                        <input type="hidden" value="1" name="approve_order">
                                        <input type="hidden" value="2" name="cancel_order">
                                        <?php
                                        if ($get_row['status'] == '1') {
                                            $res = 'disabled';
                                        } else if ($get_row['status'] == '2') {
                                            $res = 'disabled';
                                        } else {
                                            $res = '';
                                        }
                                        ?>
                                        <button type='submit' name='approve'
                                                class='btn btn-success' <?php echo $res; ?>>Approve
                                        </button>
                                        <button type='submit' name='cancel' class='btn btn-danger' <?php echo $res; ?>>
                                            Cancel
                                        </button>
                                    </form>
                                </td>
                                <?php
                                if ($get_row['status'] == '1') {
                                    echo "<td class='text-success'> <b>Completed</b> </td>";
                                } else if ($get_row['status'] == '2') {
                                    echo "<td class='text-danger'> <b>Canceled</b> </td>";
                                 } else {
                                    echo "<td class='text-info'> <b>Pending</b> </td>";
                                  }
                                            ?>

                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                    }
                            } else {
                                echo "";
                            }
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Dashboard2 ends here -->


            
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
<script>

</script>

</body>
</html>