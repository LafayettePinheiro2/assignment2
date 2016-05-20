<?php
session_start();
require_once '../classes/News.php';
require_once '../functions.php';

$id = $_GET['new-id'];
$new = News::getNewBy('id', $id);

$previousPage = $_SERVER['HTTP_REFERER'];
$nextPage = getHomepage();

if($new->delete()){
    $_SESSION['success_msg'] = '<div class="container">
        <div class="alert alert-success">
            <span>New deleted with success.</span>
        </div>
    </div>';        
    header("Location: {$nextPage}"); 
    exit();
} else {
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>It happened some problem while deleting this new. Please try again.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

