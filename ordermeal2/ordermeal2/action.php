<?php


include 'crud.php';

if (isset($_POST["action"]))
{

    if ($_POST["action"] == "Register")
    {

        $fname = mysqli_real_escape_string($obj->connect, $_POST["firstname"]);
        $lname = mysqli_real_escape_string($obj->connect, $_POST["lastname"]);
        $email = mysqli_real_escape_string($obj->connect, $_POST["email"]);
        $password = mysqli_real_escape_string($obj->connect, $_POST["password"]);
        $address = mysqli_real_escape_string($obj->connect, $_POST["address"]);
        $phone = mysqli_real_escape_string($obj->connect, $_POST["phone"]);


        $query = "INSERT INTO user (firstname,lastname,email,password,address,phone)
                  VALUES ('".$fname."','".$lname."','".$email."','".$password."','".$address."','".$phone."') ";

        $obj->execute_query($query);
        echo 'Success!, You can now order your meal';
    }
    else {
        echo "Ooops! Your data cannot be process now";
    }
}




?>

