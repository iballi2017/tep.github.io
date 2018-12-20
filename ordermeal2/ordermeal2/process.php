<?php
// process.php

include("Database/db.php");

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
    // if any of these variables don't exist, add an error to our $errors array

    if (empty($_POST['firstname']))
        $errors['fname'] = 'FirstName is required.';

    if (empty($_POST['lastname']))
        $errors['lname'] = 'LastName is required.';

    if (empty($_POST['email']))
        $errors['email'] = 'Email is required.';
    
    if (empty($_POST['password']))
        $errors['password'] = 'Password is required.';

    if (empty($_POST['address']))
        $errors['address'] = 'Address is required.';

    if (empty($_POST['phone']))
        $errors['phone'] = 'Phone number is required.';

    

// return a response ===========================================================

    // if there are any errors in our errors array, return a success boolean of false
    if ( ! empty($errors)) {

        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;

    } else {

        $data['success'] = true;
        $data['message'] = 'Success!';

            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];

            $sql="INSERT INTO `user` ( `id`, 
                                        `firstname`, 
                                        `lastname`, 
                                        `email`, 
                                        `password`,
                                        `address`,
                                        `phone`) VALUES (NULL, '$fname', '$lname','$email','$password',
                                                                '$address', '$phone')";
            if ($this->con->query($sql) === TRUE) {
                echo "data inserted";
            }

            else 
            {
                echo "failed";
            }
    }

    // return all our data to an AJAX call
    echo json_encode($data);