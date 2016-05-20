<?php

session_start();
require_once "../classes/Category.php";
require_once "../functions.php";

unset($_SESSION['error_msg']);
unset($_SESSION['success_msg']);

$previousPage = $_SERVER['HTTP_REFERER'];

$name = $_POST['name'];

if($name == "") {        
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>All the fields are obligatory.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

if($categoryExists = Category::getCategoryByName($name)) {        
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>There is already an category with this name. Categories are unique.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}

$category = new Category($id, $name);

if($category->save()) {   
    $_SESSION['success_msg'] = '<div class="container">
        <div class="alert alert-success">
            <span>Category registered with success.</span>
        </div>
    </div>';        
    $nextPage = getHomepage() . '/categories.php';
    header("Location: {$nextPage}"); 
    exit();
}

header("Location: {$previousPage}"); 
exit();

?>