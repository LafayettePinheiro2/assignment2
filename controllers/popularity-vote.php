<?php

session_start();

require_once "../classes/User.php";
require_once "../classes/News.php";
require_once "../functions.php";

$homepage = getHomepage();

$currentNewId   = $_POST['new-id'];
$popularityNote = $_POST['popularity'];

$new = News::getNew($currentNewId);
$new->votePopularity($popularityNote);

$_SESSION['success_msg'] = '<div class="container">
    <div class="alert alert-success">
        <span>Ranked with success</span>
    </div>
</div>'; 


//cookie to control if user has voted on this post
$data = array();
if(isset($_COOKIE['votes'])) {
    $data = unserialize($_COOKIE['votes']);
    $data[] = $currentNewId;
} else {
    $data[0] = $currentNewId;    
}

$redirectUrl = $_SERVER['HTTP_REFERER'];
header("refresh: 1; url=$redirectUrl");

setcookie('votes', serialize($data), time() + (86400 * 10), "/"); // 10 days cookie
echo "Processing, please wait...";