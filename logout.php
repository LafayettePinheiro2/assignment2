<?php
session_start();

include "functions.php";

unset($_SESSION['user_logged_in']);
unset($_SESSION['user_logged_email']);
unset($_SESSION['user_logged_name']);
unset($_SESSION['user_logged_surname']);

$homepage = getHomepage();

header("Location: {$homepage}");    