<?php
/**
 * Created by PhpStorm.
 * User: HYPERTEX
 * Date: 12/16/2018
 * Time: 7:34 PM
 */

include('crud.php');

//print_r($_REQUEST);
$total_amount=$_POST['price'];
$quantity=$_POST['quantity'];
$location=$_POST['location'];
$ref=$_POST['ref'];

$res=$obj->processOrder($_POST['price'],$_POST['quantity']);
$order_id=mysqli_insert_id($obj->connect);
if($res) {
    $obj->processPayment($ref, $total_amount, $order_id);

    foreach ($_SESSION['cart'] as $key => $value) {

        $res2 = $obj->processOrderDetails($value['meal_name'], $value['meal_quantity'], $value['meal_price'], $value['meal_id'], $order_id, $location);

    }
}
if($res2){
    unset($_SESSION['cart']);
    echo 'true';
}

?>