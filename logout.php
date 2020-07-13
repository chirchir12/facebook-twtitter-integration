<?php 
require_once('./private/init.php');
unset($_SESSION['fb_access_token']);
redirect_to('login.php');
?>