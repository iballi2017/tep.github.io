<?php
    include ('crud.php');
    //print_r($_SESSION);
if(isset($_POST['add'])){
    $meal_id=$_POST['meal_id'];

    if(isset($_SESSION['cart'][$meal_id])){

        $quantity=$_SESSION['cart'][$meal_id]['meal_quantity'];
        $quantity=$quantity+1;
        //print_r($_SESSION['cart'][$meal_id]);
        $_SESSION['cart'][$meal_id]['meal_quantity']=$quantity;
    }
}


if(isset($_POST['remove'])){
    $meal_id=$_POST['meal_id'];
    if($_SESSION['cart'][$meal_id]['meal_quantity']>1) {
        if (isset($_SESSION['cart'][$meal_id])) {
            $quantity = $_SESSION['cart'][$meal_id]['meal_quantity'];
            $quantity = $quantity - 1;
            //print_r($_SESSION['cart'][$meal_id]);
            $_SESSION['cart'][$meal_id]['meal_quantity'] = $quantity;
        }
    }
}



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

if (isset($_GET['action'])) {
    if ($_GET['action'] =='delete') {
            if ( $_GET['id'] == 0) {
                unset($_SESSION['cart']);
                echo '<script>alert(" All Product has been Remove...!")</script>';
                echo '<script>window.location="cart-view.php"</script>';


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
    <link rel="stylesheet" href="css/cartView1.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <title>Order meals</title>

</head>
<body>
    <header>
        <div class="desktop-nav">
            <nav class="navbar  navbar-fixed-top mynav">
                <div class="navbar-logo"><a class="navbar-brand" href="user.php"><img src="photos/Logo.png" class="img img-responsive"></a></div>
         	<a href="personal-info.php"><img src="photos/profile-image.png" class="img img-responsive profile-image"></a>
         	<a href="cart-view.php"><img src="photos/basket.png" class="img img-responsive basket">
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
        <span class="navbar-header"><a class="navbar-brand" href="user.php"><img src="photos/Logo.png" class="img img-responsive logo"></a></span>
        <div class="mobile-navbutton">
            <div class="cont" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
         <div class="mobile-nav-icons">
         	<a href="cart-view.php"><img src="photos/basket.png" class="img img-responsive basket"></a>

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
                     <a href="user.php" id="profile">Profile</a>
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
                                <a href="order-history.php" class="history">Order History</a>
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
                <div class="container catrView1Container">
                    <a href="javascript:void(0)" class="backbtn" onclick="goBack()">&#11013;</a>
                    <!-- /////////////////////////// -->
                    <form method="post" action="">
                    <?php
                    $total = 0;
                    if (!empty($_SESSION['cart'])) {

                    foreach ($_SESSION['cart'] as $key => $value) {

                        $id = $value['meal_id'];
                        $get = $obj->execute_query("SELECT * FROM meals WHERE meal_id=$id");
                        while ($get_row = mysqli_fetch_assoc($get)) {
                            $sub = $get_row['price'] * $value['meal_quantity'];
                            ?>

                            <div class="row itemContainer">
                                <div class="col-md-6 colum1">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <img src="photos/<?php echo $get_row['picture']; ?>" alt="Item image"
                                                 class="img img-responsive">
                                        </div>
                                        <div class="col-md-7">
                                            <h4 style="position: absolute; margin-left: -70px; margin-top: 30px"><?php echo $get_row['meal_name']; ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 colum2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form method="POST" action="cart-view.php" >
                                                <input type="hidden" name="meal_id" value="<?php echo $id; ?>" />
                                            <h4>₦ <b><input type="text" id="price" value="<?php echo $get_row['price']; ?>"></b> <button type="submit" name="remove">[-]</button>&nbsp; <?php echo $value['meal_quantity']; ?>&nbsp; <button type="submit" name="add">[+]</button> </h4>

                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>₦
                                                        <span id="subAmount"><?php echo number_format($sub, 2); ?></span>
                                                    </h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4>
                                                        <button type="submit" id="save_qty" name="save_qty"
                                                                class="update">Update
                                                        </button>
                                                    </h4>
                                                    <p>
                                                        <a href="cart-view.php?action=delete&id=<?php echo $get_row['meal_id']; ?>">
                                                            Remove</a></p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- //////////// -->
                            <?php
                            $total = $total + ($value['meal_quantity'] * $get_row['price']);
                        }
                    }

                    ?>

                     <div class="row remove-cont">
                         <div class="col-md-10">
                             <h4><a href="cart-view.php?action=delete&id=0">Remove All</a></h4>
                         </div>
                         <div class="col-md-2">
                             <h4><a href="menu.php"> Continue Shopping</a></h4>
                         </div>
                     </div>
                    <div class="form-inline">
                    <div class="row remove-cont">
                        <div class="col-md-9">
                            <label class="text-info" for="dept">Select Delivery Location(Department)</label>
                            <select class="form-control" id="dept" name="dept" style="width: 150px">
                                <option>Admin</option>
                                <option>Tech</option>
                                <option>LEAR Nigeria</option>
                                <option>C.E.O</option>
                            </select>

                        </div>
                    </div>

                    <div class="row remove-cont">
                        <div class="col-md-9">
                        <label class="text-info" for="saveloc">Save as delivery location</label>
                        </div>
                    </div>
               </div>


                    <div class="row totalAmount">
                         <div class="col-md-8">
                             <p>
                                 <?php
                                 $cart_total = 0;
                                 if (!empty($_SESSION['cart'])) {
                                     foreach ($_SESSION['cart'] as $key => $value) {
                                         $cart_total = $cart_total + ($value['meal_quantity']);
                                     }
                                     echo $cart_total . ' items('.$cart_total.')';
                                 }
                                 ?>
                             </p>
                         </div>
                         <div class="col-md-2">
                             <h4 id="tot">₦ <?php echo number_format($total, 2); ?></h4>
                         </div>
                         <div class="col-md-2">
                             <form  method="post">
                                 <input type="hidden" name="cmd" value="_xclick">
                                 <input type="hidden" name="business" value="you@youremail.com">
                                 <input type="hidden" name="item_name" value="Item Name">
                                 <input type="hidden" name="currency_code" value="USD">
                                 <input type="hidden" name="amount" value="0.00">
                                 <input type="button" onclick="payWithPaystack(<?php echo floor($total); ?>)" class="btn btn-success col-md-12"  name="submit" value="Pay Now">
                             </form>
                         </div>
                     </div>
                     <?php
                    } else { echo '<b class="text-danger">No meal Available in cart</b><br><br>'; }
                    ?>
                    </form>
                </div>
           </div>
       </div>
    </div>


    <script src="js/boot-js/jquery.min.js"></script>
    <script src="js/boot-js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/load_data.js"></script>
    <script src="js/user.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>

        function ProcessOrder(ref,price,quantity){
            var location=$('#dept').val();

            var data={"price":price,"quantity":quantity,"location":location,"ref":ref};
            $.ajax({
                url: "processPaymentAndOrder.php",
                method: "POST",
                data:data,
                success:function(data) {
                    console.log(data);
                    if (data === 'success') {
                     //   window.location.replace("user.php");
                        window.location.reload();
                    } else {
                        //alert("Username do not match any record");
                    }
                }
            });
        }

        function payWithPaystack(amount){
            var handler = PaystackPop.setup({
                key: 'pk_test_1a34249a3d55daf8b893797ed04e9cde3b5d37dd',
                email: '<?php echo $_SESSION['email']; ?>',
                amount: amount*100,
                ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                metadata: {
                    custom_fields: [
                        {
                            variable_name: "mobile_number",
                            display_name: "Mobile Number",
                           value: "<?php echo $_SESSION['phone_num']; ?>"
                        },
                        {
                            variable_name: "quantity_sold",
                            display_name: "Total Item Purchased",
                           value: "<?php echo $cart_total; ?>"
                        }
                    ]
                },
                callback: function(response){
                    alert('success. transaction ref is ' + response.reference);
                    ProcessOrder(response.reference,amount,'<?php echo $cart_total; ?>')
                },
                onClose: function(){
                    alert('Transaction Cancelled');
                }
            });
            handler.openIframe();
        }
    </script>

</body>
</html>