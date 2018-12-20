<?php

include "crud.php";

//if (isset($_POST['add'])) {
//    if (isset($_SESSION['cart'])) {
//        $item_array_id = array_column($_SESSION['cart'], 'meal_id');
//        if(!in_array($_GET['id'], $item_array_id)) {
//            $count = count($_SESSION['cart']);
//
//            $item_array = array (
//                'meal_id'       => $_GET['id'],
//                'meal_name'     => $_POST['hidden_name'],
//                'meal_price'    => $_POST['hidden_price'],
//                'meal_picture'    => $_POST['hidden_picture'],
//                'meal_quantity' => $_POST['meal_quantity'],
//            );
//            $_SESSION['cart'][$count] = $item_array;
//
//            echo '<script>window.location="menu.php"</script>';
//        } else {
//            echo '<script>alert("Product is already Added to Cart")</script>';
//            echo '<script>window.location="menu.php"</script>';
//        }
//    } else {
//        $item_array = array(
//            'meal_id'       => $_GET['id'],
//            'meal_name'     => $_POST['hidden_name'],
//            'meal_price'    => $_POST['hidden_price'],
//            'meal_quantity' => $_POST['meal_quantity'],
//        );
//        $_SESSION['cart'][0] = $item_array;
//    }
//}


//if (isset($_GET['action'])) {
//    if ($_GET['action'] =='delete') {
//        foreach ($_SESSION['cart'] as $keys => $value) {
//            if ($value['meal_id'] == $_GET['id']) {
//                unset($_SESSION['cart'][$keys]);
//                echo '<script>alert("Product has been Remove...!")</script>';
//                echo '<script>window.location="checkout.php"</script>';
//
//
//            }
//        }
//    }
//
//}



$totalAmount = 0;
$totalQuantity = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $totalAmount = $totalAmount + ($value['meal_quantity'] * $value['meal_price']);
            $totalQuantity = $totalQuantity + $value['meal_quantity'];
        }

        $dt = new DateTime();
    }



$user = $obj->get_fulldetails($_SESSION['email']);



if (isset($_POST['add'])) {
    $myArray = array(
        "user_id" => $user['user_id'],
        "order_total_price"    => number_format($totalAmount, 2),
        "order_quantity"    => $totalQuantity,
        "order_date"    =>  date("F jS, Y, g:i a", strtotime("now"))
    );

    if ($obj->insert_meal_order("order", $myArray)) {
        header("location:Cart.php?msg=Your Order as been place");
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

$meal1 = $obj->get_all_meals_id();
var_dump($meal1) ;

?>
<form action="Cart.php?action=add&id=<?php echo $meal1['meal_id']; ?>" method="post">
    <input type="submit" name="add" value="ADD ORDER">
</form>
</body>
</html>
