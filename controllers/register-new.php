<?php

session_start();
require_once "../classes/News.php";
require_once "../functions.php";

unset($_SESSION['error_msg']);
unset($_SESSION['success_msg']);

$previousPage = $_SERVER['HTTP_REFERER'];

$title    = $_POST['title'];
$content  = nl2br($_POST['content']);
$category = $_POST['category'];

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

if($userId = getActiveUserId()) { 
    $new = new News($id, $title, $content, $userId, 0 , 0, 0, $category);

    if($new->save()) {   
        $_SESSION['success_msg'] = '<div class="container">
            <div class="alert alert-success">
                <span>New registered with success.</span>
            </div>
        </div>';        
        $nextPage = getHomepage();
        header("Location: {$nextPage}"); 
        exit();
    }
} else {
    $_SESSION['success_msg'] = '<div class="container">
            <div class="alert alert-danger">
                <span>You need to be logger in to register news.</span>
            </div>
        </div>'; 
    $homepage = getHomepage();
    header("Location: {$homePage}"); 
}


header("Location: {$previousPage}"); 
exit();

?>