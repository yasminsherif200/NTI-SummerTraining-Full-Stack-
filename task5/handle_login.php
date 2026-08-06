<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = [];

    if(empty($email)){
        $errors[] = "You must fill email";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Please enter a valid email";
    }

    if(empty($password)){
        $errors[] = "You must fill password";
    }
    elseif(strlen($password) < 3 || strlen($password) > 12){
        $errors[] = "The password should be between 3 and 12 characters";
    }

    if($errors){
        $_SESSION['errors'] = $errors;
        header('location:account.php');
        exit();
    }

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    header('location:products.php');
    exit();

}
else{
    echo "Invalid request";
}
