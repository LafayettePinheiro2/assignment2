<?php
if (!empty($_SESSION['error_msg'])) {
    echo $_SESSION['error_msg'];
    unset($_SESSION['error_msg']);
}

if (!empty($_SESSION['success_msg'])) {
    echo $_SESSION['success_msg'];
    unset($_SESSION['success_msg']);
}
?>