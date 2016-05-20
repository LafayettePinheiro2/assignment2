<?php

session_start();
include "../classes/User.php";
include "../functions.php";

unset($_SESSION['error_msg']);
unset($_SESSION['success_msg']);

$previousPage = $_SERVER['HTTP_REFERER'];

$name            = $_POST['name'];
$surname         = $_POST['surname'];
$password        = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$email           = $_POST['email'];

if($name == "" || $surname == "" || $password == "" || $confirmPassword == "" || $email == "") {        
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>All the fields are obligatory.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

if($password != $confirmPassword) {        
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>Password do not match password confirmation.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

$hashedPassword = crypt($password);

$user = new User($id, $name, $surname, $hashedPassword, $email, 0);

if($user->userExists($email)) {        
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>This email is already registered.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

if($user->save()) {   
    $_SESSION['success_msg'] = '<div class="container">
        <div class="alert alert-success">
            <span>User registered with success. Log in to access!</span>
        </div>
    </div>';        
    $nextPage = getHomepage() . '/login.php';
    header("Location: {$nextPage}"); 
    exit();
}

header("Location: {$previousPage}"); 
exit();

?>