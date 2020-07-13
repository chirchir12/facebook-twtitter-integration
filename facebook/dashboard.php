<?php

require_once('../private/init.php');

$response = json_decode(getRecentPost());
$all_mesages = json_decode(getComments());

// reply to message
$message = '';
$id="";
if(is_post_request()){
    $reply = $_POST['reply'];
    $id = $_POST['id'];
    reply_to_comment($id, $reply);
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
                <h3 class=" h2">Page Recent Post</h3>
                <div class="post border-bottom">
                    <p><a href="" class="nav-link">

                            <?php 
               
                echo ($response[0]->message);
                ?>
                        </a></p>
                    <div class="post-footer d-flex justify-content-between">
                        <div class="comment-container">
                            <h6 class="h5">Comments</h6>


                            <?php foreach ($all_mesages as $message) { ?>
                            <div class="comment ml-4">
                                <span><?php echo $message-> message?></span>
                                <div class="commment-reply d-flex justify-content-end flex-column">
                                </div>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?php echo $message-> id ?>">
                                    <?php $replies = get_list_replies($message->id); ?>

                                    <?php foreach(json_decode($replies) as $user_reply){?>
                                    <p class="text-muted ml-5"><?php echo $user_reply-> message?></p>
                                    <?php }?>
                                    <div class="d-flex ">


                                        <textarea name="reply" rows="1" class=" ml-5 form-control mb-3"></textarea>
                                        <div class="ml-2">
                                            <button type="submit"
                                                class=" ml-auto btn btn-primary d-inline-block">reply</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <?php } ?>


                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="lead h3">Messanger</h3>

                <?php 
                
                $pageInfo = json_decode(getPageInfo());
               
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