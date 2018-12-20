<?php

include ('crud.php');

if($obj->isLogin() == false) { header('Location: index.php'); }

if($obj->isAdminLogin() == false) { die("Unauthorized Page"); }

if (isset($_GET['meal_action'])) {
    if ($_GET['meal_action'] == 'add') {
        $_SESSION['umeal'] = $_GET['id'];
    }
}

if (isset($_POST['delete'])) {
    $meal = $_POST['meal_id'];
    $sql = $obj->execute_query("DELETE FROM meals WHERE meal_id=$meal");
    if ($sql){
        header('Location:dashboard-menu.php');
    } else {
        $message ="Unable to complete action... Possibly we have the record in Order Table";
    }

}


if (isset($_POST['submit'])) {

    if (($_POST['categories']== "") || ($_POST['meal_name'] =="") || ($_POST['description'])=="" || ($_POST['price'])=="" || ($_POST['qty'])=="") {
        $message = "<span class='text-danger'>Any of this field cannot be empty</span>";
    } else {

        $categories = mysqli_real_escape_string($obj->connect, $_POST['categories']);
        $meal_name = mysqli_real_escape_string($obj->connect,$_POST['meal_name']);
        $description = mysqli_real_escape_string($obj->connect,$_POST['description']);
        $price = mysqli_real_escape_string($obj->connect,$_POST['price']);
        $qty = mysqli_real_escape_string($obj->connect,$_POST['qty']);

        $image_name = $_FILES['file']['name'];
        $temp_name = $_FILES["file"]["tmp_name"];
        $ext = explode('.',$_FILES['file']['name']);
        $file_extension = strtolower(end($ext));
        $file_size =$_FILES['file']['size'];
        $expensions = array("jpeg","jpg","png","gif");
        if(in_array($file_extension,$expensions)=== false){
            $message = "File Type Not allowed, Please choose a JPEG or PNG file.";
        }
        if($file_size > 500000){
            $message = "<span class='text-danger'> File size Too Large !! </span>";
        }
        if(empty($message)==true) {
            move_uploaded_file($temp_name, $_SERVER['DOCUMENT_ROOT'] . "/photos/" . $image_name);

            $sql = $obj->execute_query("UPDATE meals SET model='$categories',meal_name='$meal_name',picture='$image_name',description='$description',price=$price,quantity=$qty where meal_id='" . $_SESSION['umeal'] . "'");
            if ($sql) {
                $message = "<span class='text-info'>Item Altered </span>";
            } else {
                $message = "<span class='text-danger'>Oops, There seems to be server issues, try again later</span>";
            }
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
      <link rel="stylesheet" href="css/dashboard-EditItem.css">
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
            <div class="col-xs-12 col-md-7 col-md-offset-4">
                    <a href="javascript:void(0)" class="backbtn" onclick="goBack()">&#11013;</a>
                 <!-- Add New Item Settings content begins here -->
                <h3>Edit this Item</h3>
<?php

$meal = $obj->get_meal_by_id($_SESSION['umeal']);

?>
                 <div class="row" id="dashboardContainer">
                        <form class="form-horizontal" role="form" action="dashboard-edit-item.php" method="post" enctype="multipart/form-data">
                            <h4 class="text-center"><?php if(isset($message)) echo $message; else echo ""; ?></h4>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <label for="categories" class="col-sm-2 control-label">Categories</label>
                                    <div class="col-sm-9 col-sm-offset-1">
                                        <select class="form-control" name="categories" id="categories" style="width: 150px">
                                            <option value="">Categories</option>
                                            <option value="Swallows" <?php if ($meal['model'] == 'Swallows') echo 'selected'; ?>>Swallows</option>
                                            <option value="Sandwiches" <?php if ($meal['model'] == 'Sandwiches') echo 'selected'; ?>>Sandwiches</option>
                                            <option value="Break_lunch" <?php if ($meal['model'] == 'Break_lunch') echo 'selected'; ?>>Break_lunch</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <label for="meal" class="col-sm-2 control-label">Meals</label>
                                    <div class="col-sm-9 col-sm-offset-1">
                                        <input type="text" class="form-control" id="meal_name" name="meal_name" value="<?php echo $meal['meal_name']; ?>" placeholder="Meal">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <label for="file" class="col-sm-2 control-label">Picture</label>
                                    <div class="col-sm-9 col-sm-offset-1">
                                        <input type="file" class="form-control" id="file" name="file" value="<?php $meal['picture']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9">
                                        <label for="description" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-9 col-sm-offset-1">
                                        <textarea class="form-control" id="description" name="description" rows="6" placeholder="Description"> <?php echo $meal['description'];; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <label for="description" class="col-sm-12 control-label">Price (₦)</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="price" name="price" value="<?php echo $meal['price']  ?>" placeholder="Price (#)">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="qty" class="col-sm-3 Qty">Qty</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="qty" name="qty">
                                              <option value="1" <?php if ($meal['quantity'] == 1) echo 'selected'; ?>>1</option>
                                              <option value="2" <?php if ($meal['quantity']  == 2) echo 'selected'; ?>>2</option>
                                              <option value="3" <?php if ($meal['quantity']  == 3) echo 'selected'; ?>>3</option>
                                              <option value="4" <?php if ($meal['quantity']  == 4) echo 'selected'; ?>>4</option>
                                              <option value="5" <?php if ($meal['quantity']  == 5) echo 'selected'; ?>>5</option>
                                              <option value="6" <?php if ($meal['quantity']  == 6) echo 'selected'; ?>>6</option>
                                              <option value="7" <?php if ($meal['quantity']  == 7) echo 'selected'; ?>>7</option>
                                              <option value="8" <?php if ($meal['quantity']  == 8) echo 'selected'; ?>>8</option>
                                              <option value="9" <?php if ($meal['quantity']  == 9) echo 'selected'; ?>>9</option>
                                              <option value="10" <?php if ($meal['quantity']  == 10) echo 'selected'; ?>>10</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-5 col-md-4 col-md-offset-2">
                                    <button type="submit" class="btn btn-success btn-sm save">Save</button>
                                </div>
                            </div>
                        </form>
                </div>
                <!-- Add New Item Settings content ends here -->
                
            </div>
    </div>

        <script src="js/boot-js/jquery.min.js"></script>
        <script src="js/boot-js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/load_data.js"></script>
        <script src="js/user.js"></script>

</body>
</html>