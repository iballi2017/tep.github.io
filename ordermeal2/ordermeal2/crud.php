<?php
session_start();

class Crud 
{
    public $connect;
    public $obj;
    
    private $host ="localhost";
    private $username = "root";
    private $password = "";
    private $database = "ordermeal";


    function  __construct()
    {
        $this->database_connect();

    }

    public function database_connect()
    {
        $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
    }

    public function execute_query($query)
    {
        return mysqli_query($this->connect, $query);
    }

    public function get_fulldetails($email){

	            $sql3="SELECT user_id, firstname, lastname,email, address, phone FROM user WHERE email = '".$email."'";

	            $result = mysqli_query($this->connect, $sql3);

	            $user_data = mysqli_fetch_assoc($result);

	            return $user_data;

    }

    public function get_meal_by_id($id){

        $sql3="SELECT * FROM meals WHERE meal_id = '".$id."'";
        $result = mysqli_query($this->connect, $sql3);
        $meal_data = mysqli_fetch_assoc($result);

        return $meal_data;
    }

    public function approve_cancel_order($value, $id) {

        $sql3 = $this->execute_query("UPDATE orders SET status=$value WHERE order_id=$id");
        mysqli_query($this->connect, $sql3);

        return true;
    }

    public function insert_record($table, $fields) {
        // "INSERT INTO table_name (, , ) VALUES ('', '')";
        $sql="";
        $sql .= "INSERT INTO " . $table;
        $sql .= " (" . implode(',', array_keys($fields)) . ") VALUES ";
        $sql .= "('" .implode("','", array_values($fields)) . "')";

        $query = mysqli_query($this->connect, $sql);

        if ($query) {
            return true;
        }

    }

    public function get_all_Break_lunch_meals () {
        $meal = array();
        $query = "SELECT * FROM meals where model='Break_lunch'";
        $result = $this->execute_query($query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $meal[] = $row;
            }
            return $meal;
        }
    }

    public function get_all_Sandwiches_meals () {
        $meal = array();
        $query = "SELECT * FROM meals where model='Sandwiches'";
        $result = $this->execute_query($query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $meal[] = $row;
            }
            return $meal;
        }
    }

    public function get_all_Swallows_meals () {
        $meal = array();
        $query = "SELECT * FROM meals where model='Swallows'";
        $result = $this->execute_query($query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $meal[] = $row;
            }
            return $meal;
        }
    }

    public function get_all_meals_id() {
        $meal = array();
        $query = "SELECT * FROM meals";
        $result = $this->execute_query($query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $meal[] = $row;
            }
            return $meal;
        }
    }

    public function insert_meal_order($table, $fields) {

        $sql="";
        $sql .= "INSERT INTO " . $table;
        $sql .= " (" . implode(',', array_keys($fields)) . ") VALUES ";
        $sql .= "('" .implode("','", array_values($fields)) . "')";

        $query = $this->execute_query($sql);

        if ($query) {
            return true;
        }

    }


    public function processPayment($ref,$amount, $order_id) {

        $sql="insert into payment set user_id=".$_SESSION['user_id'].",amount=$amount,order_id=$order_id,ref='$ref'";
        $query = $this->execute_query($sql);
        if ($query) {
            return true;
        }
        else{
            die(mysqli_error($this->connect));
        }

    }


    public function processOrder($price, $quantity) {

        $sql="insert into `orders` set
 user_id=".$_SESSION['user_id'].",
 order_total_price='$price',
 order_quantity=$quantity";
        $query = $this->execute_query($sql);
        if ($query) {
            return true;
        }else{
            die(mysqli_error($this->connect));
        }

    }



    public function processOrderDetails($meal_name, $quantity,$price,$meal_id,$order_id,$location) {

        $sql="insert into order_details set order_meal_name='$meal_name',order_meal_quantity=$quantity,order_meal_price='$price',meal_id=$meal_id,order_id=$order_id,location='$location'";
        $query = $this->execute_query($sql);
        if ($query) {
            return true;
        }
        else{
            die(mysqli_error($this->connect));
        }

    }

    public function admin_insert_meal($category,$meal_name,$image,$description,$price,$quantity) {

        $sql="insert into meals set model='$category',meal_name='$meal_name',picture='$image',description='$description',price=$price,quantity=$quantity";
        $query = $this->execute_query($sql);
        if ($query) {
            return true;
        }
        else{
            die(mysqli_error($this->connect));
        }

    }

    public function isLogin() {
        if($this->UserIsLogin()) {
            return true;
        }
        else {
            return false;
        }
    }

    private function UserIsLogin()
    {
        if (isset($_SESSION['email'])) {
            return true;
        }
    }

    private function AdminIsLogin()
    {
        if (isset($_SESSION['role_id'])) {
            if ($_SESSION['role_id'] == 1) {
                return true;
            }
        }
    }

    public function isAdminLogin() {
        if($this->AdminIsLogin()) {
            return true;
        }
        else {
            return false;
        }
    }


}
$obj = new Crud;


?>