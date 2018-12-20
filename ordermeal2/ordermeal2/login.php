<?php

include 'crud.php';

if (isset($_POST["action2"]))
{
    if ($_POST["action2"] == "Login")
    {
        $email = mysqli_real_escape_string($obj->connect, $_POST["l_email"]);
        $password = mysqli_real_escape_string($obj->connect, $_POST["l_password"]);


        $query = "SELECT * FROM user where email = '". $email ."' and password = '".$password."'";
        $result = $obj->execute_query($query);
        if(mysqli_num_rows($result) > 0) {
            while ($row=mysqli_fetch_array($result,MYSQLI_BOTH)) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION["email"] = $row["email"];
                $_SESSION["u_name"] = $row["firstname"]. " ".$row["lastname"];
                $_SESSION["phone_num"] = $row["phone"];
                $_SESSION["role_id"] = $row["role"];

                if ($row['role'] == 0) { echo 'success'; } else { echo "success2"; }
            }
        } else {
            echo "fail";
        }

    }

}



?>