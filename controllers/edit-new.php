<?php

session_start();
include "../classes/News.php";
require_once "../functions.php";

unset($_SESSION['error_msg']);
unset($_SESSION['success_msg']);

$previousPage = $_SERVER['HTTP_REFERER'];

$id              = $_POST['id'];
$title           = $_POST['title'];
$content         = $_POST['content'];
$category        = $_POST['category'];

$category = ($category == "") ? null : $category; 


if($title == "" || $content == "") {        
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>The fields title and content are obligatory.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

$new = News::getNewBy('id', $id);

if($new->edit($id, $title, $content, $category)) {   
    $_SESSION['success_msg'] = '<div class="container">
        <div class="alert alert-success">
            <span>New edited with success.</span>
        </div>
    </div>';        
    $nextPage = getHomepage();
    $nextPage .= 'new.php?new-id='.$id;
    header("Location: {$nextPage}"); 
    exit();
} else {
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>It happened some problem while editing this new. Please try again.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

header("Location: {$previousPage}"); 
exit();

?>