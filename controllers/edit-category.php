<?php

session_start();
include "../classes/Category.php";
require_once "../functions.php";

unset($_SESSION['error_msg']);
unset($_SESSION['success_msg']);

$previousPage = $_SERVER['HTTP_REFERER'];

$id   = $_POST['id'];
$name = $_POST['name'];

$category = Category::getCategory($id);

if($category->edit($id, $name)) {   
    $_SESSION['success_msg'] = '<div class="container">
        <div class="alert alert-success">
            <span>Category edited with success.</span>
        </div>
    </div>';        
    $nextPage = getHomepage().'/categories.php';
    header("Location: {$nextPage}"); 
    exit();
} else {
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>It happened some problem while editing this category. Please try again.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

header("Location: {$previousPage}"); 
exit();

?>