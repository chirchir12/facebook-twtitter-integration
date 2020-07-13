<?php

require_once('./private/init.php')
?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once('./common/head.php')?>
    <title>Login</title>
</head>

<body>
    <?php require_once('./common/navbar.php')?>
    <div class="container">
        <?php 
        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('http://localhost:4756/fb-callback.php', $permissions);
        
        echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
        ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php require_once('./common/jq.php')?>
</body>

</html>