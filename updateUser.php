<?php
session_start();
include "includes/book-config.inc.php";
$connection = createConnString();
if(isset($_POST['UserID'])){
    $userID = $_POST['UserID'];
    //update user's info use case
    $db = new UsersGateway($connection);
    if(isset($_POST['firstName'])){
        $fName = $_POST['firstName'];
    }
    if(isset($_POST['lastName'])){
        $lName = $_POST['lastName'];
    }
    if(isset($_POST['address'])){
        $address = $_POST['address'];
    }
    if(isset($_POST['city'])){
        $city = $_POST['city'];
    }
    if(isset($_POST['region'])){
        $region = $_POST['region'];
    }
    if(isset($_POST['country'])){
        $country = $_POST['country'];
    }
    if(isset($_POST['postal'])){
        $postal = $_POST['postal'];
    }
    if(isset($_POST['phone'])){
        $phone = $_POST['phone'];
    }
    if(isset($_POST['email'])){
        $user = $_POST['email'];
    }
    $db->updateUser($fName, $lName, $address, $city, $region, $country, $postal, $phone, $user, $userID); //updates the user in the database
    $_SESSION['Email'] = $_POST['email'];
    $_SESSION['FirstName'] = $_POST['firstName'];
    $_SESSION['LastName'] = $_POST['lastName'];
    header("location: users.php");
}else{
    //create new user use case
    $db = new UsersGateway($connection);
    
    if(isset($_POST['firstname'])){
        $fName = $_POST['firstname'];
    }
    if(isset($_POST['lastname'])){
        $lName = $_POST['lastname'];
    }
    if(isset($_POST['address'])){
        $address = $_POST['address'];
    }
    if(isset($_POST['city'])){
        $city = $_POST['city'];
    }
    if(isset($_POST['region'])){
        $region = $_POST['region'];
    }
    if(isset($_POST['country'])){
        $country = $_POST['country'];
    }
    if(isset($_POST['postal'])){
        $postal = $_POST['postal'];
    }
    if(isset($_POST['phone'])){
        $phone = $_POST['phone'];
    }
    if(isset($_POST['user'])){
        $user = $_POST['user'];
    }
    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }
    
    $status = $db->registerUser($fName, $lName, $address, $city, $region, $country, $postal, $phone, $user, $password); //creates a record for the new user in the database
    if($status == false){ //the username already exists, go back to the register page.
    header("location:register.php?reg=false");
    }else{ //a new user was successfully created, go to the login page
        header("location:login.php?reg=true");
    }
}
?>