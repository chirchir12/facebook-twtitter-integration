<?php
session_start();

// define path to directories
define('PRIVATE_PATH', dirname(__FILE__));
define('PROJECT_PATH', dirname(PRIVATE_PATH));
define('FACEBOOK_PATH', PROJECT_PATH.'/facebook');
define('LINKEDIN_PATH', PRIVATE_PATH . '/linkedin');
define('TWITTER_PATH', PRIVATE_PATH . '/twitter');
require_once(PROJECT_PATH . '/vendor/autoload.php');
require_once('enable_errors.php');
require_once('functions.php');



// FACEBOOK
$config = [
  'app_id' => '3371989819490458',
  'app_secret' => '7d0ba1c54632281a71d3b241b7bfaf7a',
  'default_graph_version' => 'v7.0',
  'user_id' => '1592301440945704',
  'page_id' => '299563640721243'
  ];
$fb = new Facebook\Facebook([
    'app_id' => '3371989819490458',
    'app_secret' => '7d0ba1c54632281a71d3b241b7bfaf7a',
    'default_graph_version' => 'v7.0',
    ]);


    function getUserNode() {
        global $fb;
        try {
            // Returns a `FacebookFacebookResponse` object
            $response = $fb->get(
              '/me',
              $_SESSION['fb_access_token']
            );
          } catch(FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(FacebookExceptionsFacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
          $graphNode = $response->getGraphNode();
          return  $graphNode;
    }

    function getPageInfo() {
        global $fb;
        try {
            // Returns a `FacebookFacebookResponse` object
            $response = $fb->get(
              '/1592301440945704/accounts',
              $_SESSION['fb_access_token']
            );
          } catch(FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(FacebookExceptionsFacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
          $graphNode = $response->getGraphEdge();
          return  $graphNode;
    }

    function getRecentPost () {
        global $fb;
        try {
            // Returns a `FacebookFacebookResponse` object
            $response = $fb->get(
              '/299563640721243/feed',
              $_SESSION['fb_access_token']
            );
          } catch(FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(FacebookExceptionsFacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
          $graphNode = $response->getGraphEdge();
          return  $graphNode;
        
    };

    // get comments for single post
    function getComments() {
        global $fb;
        try {
            // Returns a `FacebookFacebookResponse` object
            $response = $fb->get(
              '/299563640721243_561751431169128/comments',
              $_SESSION['fb_access_token']
            );
          } catch(FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(FacebookExceptionsFacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
          $graphNode = $response->getGraphEdge();
          return  $graphNode;
    }
    // get comments for single comment
    function get_list_replies($id) {
        global $fb;
        try {
            // Returns a `FacebookFacebookResponse` object
            $response = $fb->get(
              '/'.$id .'/comments',
              $_SESSION['fb_access_token']
            );
          } catch(FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(FacebookExceptionsFacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
          $graphNode = $response->getGraphEdge();
          return  $graphNode;

    }

    // rreply to comment 
    function reply_to_comment($id, $message) {
        global $fb;
        // get page access token
        $pageInfo = json_decode(getPageInfo());
        $access_token = $pageInfo[0]->access_token;
       
        try {
            // Returns a `FacebookFacebookResponse` object
            $response = $fb->post(
              '/'.$id. '/comments',
              array (
                'message' => $message,
              ),
              $access_token
            );
          } catch(FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(FacebookExceptionsFacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
          $graphNode = $response->getGraphNode();
          return  $graphNode;

    }

    // TWITTER
    // GLOBAL VARIABLES
    define('ACCESS_TOKEN', '840239390764990464-TYMlxCy1IQihXTc6gMCTsQyviGc3QPT');
    define('ACCESS_TOKEN_SECRET', 'EQ2am3dMfEaRMwboxbMOdUxzKtZlsWUygnFaZ5H4JvNzU');
    define('BEARER_TOKEN', 'AAAAAAAAAAAAAAAAAAAAAJnAFwEAAAAA1TwjPUXjj%2BOWUalQWT870l5smCU%3DQqVfKHRNgbaCreYCWiw1YdGbk3lFMg0FmeBXSjTlKR0vMEic0l');
    define('API_KEY', 'rmK1MTaMdiptjXuLBeA5V4Coy');
    define('API_KEY_SECRET', 'Mbq77QCIvQpQE6fnSB7FH4gMIoURXoPL9txRjUPNzLPKyTISrP');
    define('LOCALHOST', array(CURLOPT_SSL_VERIFYHOST=>0,CURLOPT_SSL_VERIFYPEER=>0 ));
    use Abraham\TwitterOAuth\TwitterOAuth;

    // direct messages
    $connection = new TwitterOAuth(API_KEY, API_KEY_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
    $content = $connection->get('account/verify_credentials');

    function getAllMessage($connection){
      return $connection->get('direct_messages/events/list');
    }

    function getProfile($id){
      global $connection;
      $profile = $connection->get('users/lookup', array('user_id'=>$id));
      return $profile[0]->screen_name;

    }

    function sanitizeMessages($messages) {
      $clean_messages = array();
      $events = $messages->events;
      $arrlength = count($events);
      for ($i=0; $i < $arrlength; $i++) { 
        $message_id = $events[$i]->id;
        $createdAt = $events[$i]->created_timestamp;
        $recipient_id = $events[$i]->message_create->target->recipient_id;
        $recepient_name = getProfile($recipient_id);
        $sender_id = $events[$i]->message_create->sender_id;
        $sender_name = getProfile($sender_id);
        $source_message = $events[$i]->message_create->message_data->text;
        $clean_messages[] = array(
          'message_id'=>$message_id, 
          'createdAt'=>$createdAt, 
          'recepient_id'=>  $recipient_id,
          'recepient_name' => $recepient_name,
          'sender_id' => $sender_id,
          'source_message'=>  $source_message,
          'sender_name' => $sender_name
        );

      }
      return $clean_messages;
    }

    $settings = array(
        'oauth_access_token' =>ACCESS_TOKEN,
        'oauth_access_token_secret' => ACCESS_TOKEN_SECRET,
        'consumer_key' => API_KEY,
        'consumer_secret' => API_KEY_SECRET
    );
    $twitter = new TwitterAPIExchange($settings);


    // GET RECENT TWEETS
    function get_recent_tweets() {
        global $twitter;
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $requestMethod = 'GET';
        $getFields = '?screen_name=chirmanu&count=4';
        $twitter->setGetField($getFields);
        $twitter->buildOauth($url, $requestMethod);
        $response = $twitter->performRequest(true, LOCALHOST);
        return json_decode($response, true);
    }

    //  RETWEETS
    function retweet($id, $status) {
        global $twitter;
        $url = 'https://api.twitter.com/1.1/statuses/retweet/'.$id.'.json';
        $requestMethod = 'POST';
        $postdata = array(
           'status' => $status
            
        );
      
        $twitter->setPostfields($postdata);
        $twitter->buildOauth($url, $requestMethod);
        $response = $twitter->performRequest(true, LOCALHOST);
        return json_decode($response, true);


    }



    


?>