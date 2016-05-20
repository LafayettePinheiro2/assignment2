<?php

require_once 'classes/User.php';
require_once 'classes/News.php';

function getHomepage(){
    
    return "http://localhost/Assignment2/";
//    return "http://". $_SERVER['SERVER_NAME'] . $newPage;
}

function isUserLoggedIn() {
    if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
        return true;
    }
    return false;
}

function getActiveUserId() {
    if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
        
        return $_SESSION['user_logged_id'];
    }
    return false;
}

function activeUserVoted() {
    if(isUserLoggedIn()) {
        $userId = getActiveUserId();
        
        $user = User::getUserBy('id', $userId);
        return $user->getPopularityVoted();
    }
    return true;
}


function truncateText($text, $size = 400){
    $truncated = (strlen($text) > 200) ? substr($text, 0, $size) . '...' : $text;
    return $truncated;
}

function activeUserOwnsPost($postId) {
    
    if($userId = getActiveUserId()){
        $new = News::getNew($postId);
        
        if($userId == $new->getUserId()){
            return true;
        }
    }
    return false;
}


function isActiveUserAdmin() {
    if($userId = getActiveUserId()){
        $user = User::getUserBy('id', $userId);
        
        if($user->getIsAdmin() == true || $user->getIsAdmin() == 1){
            return true;
        }
    }
    
    return false;
}

function isUserAdmin($userId) {
    $user = User::getUserBy('id', $userId);

    if($user->getIsAdmin() == true || $user->getIsAdmin() == 1){
        return true;
    }
    
    return false;
}