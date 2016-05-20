<?php

session_start();
include "../classes/User.php";
require_once "../functions.php";

unset($_SESSION['error_msg']);
unset($_SESSION['success_msg']);

$previousPage = $_SERVER['HTTP_REFERER'];

$id              = $_POST['id'];
$name            = $_POST['name'];
$surname         = $_POST['surname'];
$password        = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if($password != $confirmPassword) {        
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>Password do not match password confirmation.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

$user = User::getUserBy('id', $id);

if($password == "" && $confirmPassword == "") {        
    $hashedPassword = $user->getPassword();
} else {
    $hashedPassword = crypt($password, $user->getPassword());
}

if($user->edit($id, $name, $surname, $hashedPassword)) {   
    $_SESSION['success_msg'] = '<div class="container">
        <div class="alert alert-success">
            <span>User edited with success.</span>
        </div>
    </div>';  
    $nextPage = getHomepage();
    $nextPage .= 'users.php';
    header("Location: {$nextPage}"); 
    exit();
}

header("Location: {$previousPage}"); 
exit();

?>