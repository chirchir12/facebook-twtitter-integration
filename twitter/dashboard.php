<?php

require_once('../private/init.php');

header("content-type: application/json");

$messages = getAllMessage($connection);
echo print_r(sanitizeMessages($messages));
die()

?>


// tweets to message
$my_tweets = get_recent_tweets();

// retweet
$status ='';
$id='';
if(is_post_request()) {
// perfom the retweet
$status = $_POST['status'];
$id = $_POST['id'];
retweet($id, $status);
}



?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once('../common/head.php')?>
    <title>CRM!</title>
</head>

<body>
    <?php require_once('../common/navbar.php')?>
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-md-6 border-right 1-100">
                <h3 class=" h2">latest Tweet</h3>
                <div class="post border-bottom">
                    <?php foreach($my_tweets as $tweet) :?>
                    <a href="" class="nav-link"> <?php echo $tweet['text']?></a>


                    <div class="post-footer d-flex justify-content-between">
                        <div class="comment-container">
                            <h6 class="h5">Retweets</h6>

                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $tweet['id']?>">
                                <div class="d-flex">
                                    <textarea name="status" rows="1" id="" class="form-control mb-3"></textarea>
                                    <div class="ml-2">
                                        <button type="submit"
                                            class="btn btn-primary d-inline-block text-right">retweet</button></div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="lead h3">Direct Messages</h3>

                <?php
                //test data
                
                echo "<prev>";
                echo print_r($content)

                ?>




                <div class="message-container">
                    <p><a href="" class="nav-link">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ea
                            molestiae quae esse p.</a></p>
                    <div class="post-footer d-flex justify-content-end">
                        <form action="">
                            <textarea name="" id="" class="form-control mb-3"></textarea>
                            <button class="btn btn-primary d-inline-block text-right">reply</button>

                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div>

    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php require_once('../common/jq.php')?>
</body>

</html>