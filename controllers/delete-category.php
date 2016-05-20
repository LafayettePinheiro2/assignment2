<?php
session_start();
require_once '../classes/News.php';
require_once '../classes/Category.php';
require_once '../functions.php';

$id = $_GET['category-id'];
$category = Category::getCategory($id);

$previousPage = $_SERVER['HTTP_REFERER'];
$nextPage = getHomepage().'categories.php';

$news = News::getAllNews();

foreach($news as $new) {
    if($new->getCategoryId() == $id){
            $_SESSION['error_msg'] = '<div class="container">
            <div class="alert alert-danger">
                <span>This category is used at: - '.$new->getTitle().'. You must remove 
                    the category from the new in order to delete it.</span>
            </div>
        </div>';        

        header("Location: {$previousPage}"); 
        exit();
    }
}

if($category->delete()){
    $_SESSION['success_msg'] = '<div class="container">
        <div class="alert alert-success">
            <span>Category deleted with success.</span>
        </div>
    </div>';        
    header("Location: {$nextPage}"); 
    exit();
} else {
    $_SESSION['error_msg'] = '<div class="container">
        <div class="alert alert-danger">
            <span>It happened some problem while deleting this category. Please try again.</span>
        </div>
    </div>';        

    header("Location: {$previousPage}"); 
    exit();
}