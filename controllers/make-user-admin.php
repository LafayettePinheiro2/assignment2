<?php
session_start();
require_once '../classes/User.php';
require_once '../functions.php';

$id = $_GET['user-id'];
$user = User::getUserBy('id', $id);

$previousPage = $_SERVER['HTTP_REFERER'];
$nextPage = getHomepage().'users.php';

if($user->setUserAsAdmin()){
    $_SESSION['success_msg'] = '<div class="container">
        <div class="alert alert-success">
            <span>The user '.$user->getName().' '.$user->getSurname().' now is an admin.</span>
        </div>
    </div>';        
    header("Location: {$nextPage}"); 
    exit();
} else {
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>It happened some while turning user '.$user->getName().' '.$user->getSurname().' an admin. Please try again.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}