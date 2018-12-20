<?php

include ('crud.php');

if($obj->isLogin() == false) { header('Location: index.php'); }

if($obj->isAdminLogin() == false) { die("Unauthorized Page"); }

if (isset($_POST['submit'])) {

    if (($_POST['category']== "") || ($_POST['meal_name'] =="") || ($_POST['description'])=="" || ($_POST['price'])=="" || ($_POST['qty'])=="" || ($_FILES['file'])=="") {
        $message = "<span class='text-danger'>Any of this field cannot be empty</span>";
    } else {

        $category = mysqli_real_escape_string($obj->connect, $_POST['category']);
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
        if(empty($message)==true){
            move_uploaded_file($temp_name,$_SERVER['DOCUMENT_ROOT']."/photos/".$image_name);

            $sql = $obj->admin_insert_meal($category,$meal_name,$image_name,$description,$price,$qty);

            if ($sql) {
                $message = "<span class='text-success'>Meal Successfully Uploaded</span>";
            } else {
                $message = "<span class='text-danger'>Oops, There seems to be server issues, try again later</span>";
            }
        } else{
            $message = "<span class='text-danger'> Something is Wrong Plesae check your image </span>";
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
      <link rel="stylesheet" href="css/dashboard-AddNew.css">
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
            <div class="col-xs-12 col-md-7 col-md-offset-4">
                    <a href="javascript:void(0)" class="backbtn" onclick="goBack()">&#11013;</a>

                <h1>Add New Item</h1>

                 <div class="row" id="dashboardContainer">
                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                            <h5><?php if(isset($message)) echo $message; else echo ""; ?></h5>
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <select class="form-control" id="category" name="category" style="width: 150px">
                                        <option>Categories</option>
                                        <option>Swallows</option>
                                        <option>Sandwiches</option>
                                        <option>Break_lunch</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="meal_name" name="meal_name" placeholder="Meal">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="file" name="file">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="description" name="description" rows="6" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                         <div class="col-sm-7">
                                               <input type="text" class="form-control" id="price" name="price" placeholder="Price (₦)">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-4">
                                            <select class="form-control" id="qty" name="qty">
                                              <option>Select Quantity</option>
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                              <option>6</option>
                                              <option>7</option>
                                              <option>8</option>
                                              <option>9</option>
                                              <option>10</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="" style="">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg col-md-3">Add Item</button>
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