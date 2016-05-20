<?php
session_start();
require_once '../classes/User.php';
require_once '../functions.php';

$id = $_GET['user-id'];
$user = User::getUserBy('id', $id);

$previousPage = $_SERVER['HTTP_REFERER'];
$nextPage = getHomepage();
$nextPage .= 'users.php';

if($user->delete()){
    $_SESSION['success_msg'] = '<div class="container">
        <div class="alert alert-success">
            <span>User deleted with success.</span>
        </div>
    </div>';  
    
    if(getActiveUserId() == $id){
        $nextPage = getHomepage().'logout.php';
        header("Location: {$nextPage}");
    } else {
        header("Location: {$nextPage}");         
    }
    exit();
} else {
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>It happened some problem while deleting user. Try again.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

