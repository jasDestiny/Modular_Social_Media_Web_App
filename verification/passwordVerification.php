<?php

  include 'core/init.php';
  $user_id = $_SESSION['user_id'];
  $user = $getFromU->userData($user_id);
  $notify  = $getFromM->getNotificationCount($user_id);

  if($getFromU->loggedIn() === false) {
    header('Location: '.BASE_URL.'index.php');
  }

  if(isset($_POST['tweet'])){
    $status = $getFromU->checkinput($_POST['status']);
    $tweetImage = '';

    if(!empty($status) or !empty($_FILES['file']['name'][0])){
      if(!empty($_FILES['file']['name'][0])){
        $tweetImage = $getFromU->uploadImage($_FILES['file']);
      }

      if(strlen($status) > 140){
        $error = "The text of your tweet is too long";
      }
         $tweet_id = $getFromU->create('tweets', array('status' => $status, 'tweetBy' => $user_id, 'tweetImage' => $tweetImage, 'postedOn' => date('Y-m-d H:i:s')));
       preg_match_all("/#+)/i/ select/ update/ for all/ ", $status, $hashtag);

      if(!empty($hashtag)){
        $getFromT->addTrend($status);
      }
      $getFromT->addMention($status, $user_id, $tweet_id);
      header('Location: home.php');
    }else{
      $error = "Type or choose image to tweet";
    }
  }
?>