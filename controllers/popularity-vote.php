<?php

session_start();

require_once "../classes/User.php";
require_once "../classes/News.php";
require_once "../functions.php";

$homepage = getHomepage();

$currentNewId = $_POST['new-id'];
$popularityNote = $_POST['popularity'];

$new = News::getNew($currentNewId);
$new->votePopularity($popularityNote);

$_SESSION['success_msg'] = '<div class="container">
    <div class="alert alert-success">
        <span>Ranked with success</span>
    </div>
</div>'; 


//cookie to control if user has voted on this post
$cookieData = array();
if(isset($_COOKIE['votes'])) {
    $cookie = $_COOKIE['votes'];
    $savedCookieArray = json_decode($cookie, true);
    if(is_array($savedCookieArray)){
        $cookieData = $savedCookieArray;
        $cookieData[] = $currentNewId;
    } else {
        $cookieData[0] = $savedCookieArray;
        $cookieData[1] = $currentNewId;
    }    
} else {
    $cookieData[0] = $currentNewId;    
}

$redirectUrl = $_SERVER['HTTP_REFERER'];
header("refresh: 1; url=$redirectUrl");
setcookie('votes', json_encode($cookieData), time() + (86400 * 30), "/"); // 86400 = 1 day
echo "Processing, please wait...";

//header("Location: {$redirectUrl}");