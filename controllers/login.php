<?php

session_start();

include "../classes/User.php";
require_once "../functions.php";
$previousPage = $_SERVER['HTTP_REFERER'];

$email    = $_POST['email'];
$password = $_POST['password'];


if($password == "" || $email == ""){        
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>All the fields are obligatory.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

if(!$user = User::getUserBy('email', $email)){        
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>User not registered.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

if($user->checkPassword($email, $password)){ 
    
    $_SESSION['user_logged_in']      = true;
    $_SESSION['user_logged_id']      = $user->getId();
    $_SESSION['user_logged_email']   = $user->getEmail();
    $_SESSION['user_logged_name']    = $user->getName();
    $_SESSION['user_logged_surname'] = $user->getSurname();
    
    $nextPage = getHomepage();
    header("Location: {$nextPage}"); 
    exit();
    
} else {
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>Wrong user email or password.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

header("Location: {$previousPage}"); 
exit();

?>