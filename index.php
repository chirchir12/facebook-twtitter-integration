<?php

require_once('./private/init.php')


?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once('./common/head.php')?>
    <title>Hello, world!</title>
</head>

<body>
    <?php require_once('./common/navbar.php')?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body text-center">
                        <a href="/facebook/dashboard.php" class="nav-link">FACEBOOK</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body text-center">
                        <a href="/twitter/dashboard.php" class="nav-link">TWITTER</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body text-center">
                        <a href="/linked/posts" class="nav-link">LINKEDIN</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <?php require_once('./common/jq.php')?>
</body>

</html>