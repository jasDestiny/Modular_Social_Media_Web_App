<?php

include 'core/init.php';
 if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
  $username = $getFromU->checkInput($_GET['username']);
  $profileId = $getFromU->userIdByUsername($username);
  $profileData = $getFromU->userData($profileId);
  $user_id = @$_SESSION['user_id'];
  $user = $getFromU->userData($user_id);
  $notify  = $getFromM->getNotificationCount($user_id);

 
  if (!$profileData) {
    header('Location: '.BASE_URL.'index.php');
  }
}

?>


<!doctype html>
<html>
	<head>
	<title><?php echo $profileData->screenName.' (@'.$profileData->username.')'; ?></title>
	<meta charset="UTF-8" />
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
  	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style-complete.css"/>
  	<script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
    </head>
<!--Helvetica Neue-->
<body>
<div class="wrapper">
<!-- header wrapper -->
<div class="header-wrapper">
	<div class="nav-container">
    	<div class="nav">
		<div class="nav-left">
			<ul>
				 <li><a href="<?php echo BASE_URL; ?>home.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
      			
      			<?php if($getFromU->loggedIn()=== true){?>
					<li><a href="<?php echo BASE_URL;?>i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notifications<span id="notificaiton"><?php if($notify->totalN > 0){echo '<span class="span-i">'.$notify->totalN.'</span>';}?></span></a></li>
					<li id="messagePopup"><i class="fa fa-envelope" aria-hidden="true"></i>Messages<span id="messages"><?php if($notify->totalM > 0){echo '<span class="span-i">'.$notify->totalM.'</span>';}?></span></li>
				<?php }?>
			
			</ul>
		</div><!-- nav left ends-->
		<div class="nav-right">
			<ul>
				<li><input type="text" placeholder="Search" class="search"/><i class="fa fa-search" aria-hidden="true"></i>
					<div class="search-result">
					</div>
				</li>
        <?php if($getFromU->loggedIn() === true){ ?>
				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo BASE_URL.$user->profileImage; ?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="<?php echo BASE_URL.$user->username; ?>"><?php echo $user->username; ?></a></li>
							<li><a href="<?php echo BASE_URL; ?>settings/account">Settings</a></li>
							<li><a href="<?php echo BASE_URL; ?>includes/logout.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
				<li><label for="pop-up-tweet" class="addTweetBtn">Tweet</label></li>
      <?php }else{
        echo '<li><a href="'.BASE_URL.'index.php">Have an account? Log in!</a></li>';
      } ?>
      </ul>
		</div><!-- nav right ends-->

	</div><!-- nav ends -->
	</div><!-- nav container ends -->
</div><!-- header wrapper end -->
<!--Profile cover-->
<div class="profile-cover-wrap">
<div class="profile-cover-inner">
	<div class="profile-cover-img">
		<!-- PROFILE-COVER -->
		<img src="<?php echo BASE_URL.$profileData->profileCover; ?>"/>
	</div>
</div>
<div class="profile-nav">
 <div class="profile-navigation">
	<ul>
		<li>
		<div class="n-head">
			TWEETS
		</div>
		<div class="n-bottom">
		  <?php $getFromT->countTweets($profileId); ?>
		</div>
		</li>
		<li>
			<a href="<?php echo BASE_URL.$profileData->username; ?>/following">
				<div class="n-head">
					<a href="<?php echo BASE_URL.$profileData->username; ?>/following">FOLLOWING</a>
				</div>
				<div class="n-bottom">
					<span class="count-following"><?php echo $profileData->following; ?></span>
				</div>
			</a>
		</li>
		<li>
		 <a href="<?php echo BASE_URL.$profileData->username; ?>/followers">
				<div class="n-head">
					FOLLOWERS
				</div>
				<div class="n-bottom">
					<span class="count-followers"><?php echo $profileData->followers; ?></span>
				</div>
			</a>
		</li>
		<li>
			<a href="#">
				<div class="n-head">
					LIKES
				</div>
				<div class="n-bottom">
					<?php $getFromT->countLikes($profileId); ?>
				</div>
			</a>
		</li>
	</ul>
	<div class="edit-button">
		<span>
			<?php echo $getFromF->followBtn($profileId, $user_id, $profileData->user_id); ?>
 		</span>
	</div>
    </div>
</div>
</div><!--Profile Cover End-->
 <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/notification.js"></script>

<!---Inner wrapper-->
<div class="in-wrapper">
 <div class="in-full-wrap">
   <div class="in-left">
     <div class="in-left-wrap">
	<!--PROFILE INFO WRAPPER END-->
	<div class="profile-info-wrap">
	 <div class="profile-info-inner">
	 <!-- PROFILE-IMAGE -->
		<div class="profile-img">
			<img src="<?php echo BASE_URL.$profileData->profileImage; ?>"/>
		</div>

		<div class="profile-name-wrap">
			<div class="profile-name">
				<a href="<?php echo BASE_URL.$profileData->username; ?>"><?php echo $profileData->screenName; ?></a>
			</div>
			<div class="profile-tname">
				@<span class="username"><?php echo $profileData->username; ?></span>
			</div>
		</div>

		<div class="profile-bio-wrap">
		 <div class="profile-bio-inner">
		    <?php echo $getFromT->getTweetLinks($profileData->bio); ?>
		 </div>
		</div>

<div class="profile-extra-info">
	<div class="profile-extra-inner">
		<ul>
      <?php if(!empty($profileData->country)){ ?>
			<li>
				<div class="profile-ex-location-i">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
				</div>
				<div class="profile-ex-location">
					<?php echo $profileData->country; ?>
				</div>
			</li>
    <?php } ?>

    <?php if(!empty($profileData->website)){ ?>
			<li>
				<div class="profile-ex-location-i">
					<i class="fa fa-link" aria-hidden="true"></i>
				</div>
				<div class="profile-ex-location">
					<a href="<?php echo $profileData->website; ?>" target="_blank"><?php echo $profileData->website; ?></a>
				</div>
			</li>
    <?php } ?>

			<li>
				<div class="profile-ex-location-i">
					<!-- <i class="fa fa-calendar-o" aria-hidden="true"></i> -->
				</div>
				<div class="profile-ex-location">
 				</div>
			</li>
			<li>
				<div class="profile-ex-location-i">
					<!-- <i class="fa fa-tint" aria-hidden="true"></i> -->
				</div>
				<div class="profile-ex-location">
				</div>
			</li>
		</ul>
	</div>
</div>

<div class="profile-extra-footer">
	<div class="profile-extra-footer-head">
		<div class="profile-extra-info">
			<ul>
				<li>
					<div class="profile-ex-location-i">
						<i class="fa fa-camera" aria-hidden="true"></i>
					</div>
					<div class="profile-ex-location">
						<a href="#">0 Photos and videos </a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div class="profile-extra-footer-body">
		<ul>
			 <!-- <li><img src="#"/></li> -->
		</ul>
	</div>
</div>

	 </div>
	<!--PROFILE INFO INNER END-->

	</div>
	<!--PROFILE INFO WRAPPER END-->

	</div>
	<!-- in left wrap-->

  </div>
	<!-- in left end-->

<div class="in-center">
	<div class="in-center-wrap">

  <?php

  $tweets = $getFromT->getUserTweets($profileId);

  foreach ($tweets as $tweet) {
    $likes   = $getFromT->likes($user_id, $tweet->tweetID);
    $retweet = $getFromT->checkRetweet($tweet->tweetID, $user_id);
    $user    = $getFromU->userData($tweet->retweetBy);
    
    echo '<div class="all-tweet">
		    <div class="t-show-wrap">
		     <div class="t-show-inner">
		     '.(((isset($retweet['retweetID'])) ? $retweet['retweetID'] === $tweet->retweetID OR $tweet->retweetID > 0 : '') ? '
		      <div class="t-show-banner">
		        <div class="t-show-banner-inner">
		          <span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>'.$user->screenName.' Retweeted</span>
		        </div>
		      </div>'
		      : '').'

		      '.(((isset($retweet['tweetID'])) ? !empty($tweet->retweetMsg) && $tweet->tweetID === $retweet['tweetID'] or $tweet->retweetID > 0 : '') ? '<div class="t-show-head">
		      <div class="t-show-popup" data-tweet="'.$tweet->tweetID.'">
		        <div class="t-show-img">
		          <img src="'.BASE_URL.$user->profileImage.'"/>
		        </div>
		        <div class="t-s-head-content">
		          <div class="t-h-c-name">
		            <span><a href="'.BASE_URL.$user->username.'">'.$user->screenName.'</a></span>
		            <span>@'.$user->username.'</span>
		            <span>'.$getFromU->timeAgo($tweet->postedOn).'</span>
		          </div>
		          <div class="t-h-c-dis">
		            '.$getFromT->getTweetLinks($tweet->retweetMsg).'
		          </div>
		        </div>
		      </div>
		      <div class="t-s-b-inner">
		        <div class="t-s-b-inner-in">
		          <div class="retweet-t-s-b-inner">
		          '.((!empty($tweet->tweetImage)) ? '
		            <div class="retweet-t-s-b-inner-left">
		              <img src="'.BASE_URL.$tweet->tweetImage.'" class="imagePopup" data-tweet="'.$tweet->tweetID.'"/>
		            </div>' : '').'
		            <div>
		              <div class="t-h-c-name">
		                <span><a href="'.BASE_URL.$tweet->username.'">'.$tweet->screenName.'</a></span>
		                <span>@'.$tweet->username.'</span>
		                <span>'.$getFromU->timeAgo($tweet->postedOn).'</span>
		              </div>
		              <div class="retweet-t-s-b-inner-right-text">
		                '.$getFromT->getTweetLinks($tweet->status).'
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		      </div>' : '

		      <div class="t-show-popup" data-tweet="'.$tweet->tweetID.'">
		        <div class="t-show-head">
		          <div class="t-show-img">
		            <img src="'.BASE_URL.$tweet->profileImage.'"/>
		          </div>
		          <div class="t-s-head-content">
		            <div class="t-h-c-name">
		              <span><a href="'.$tweet->username.'">'.$tweet->screenName.'</a></span>
		              <span>@'.$tweet->username.'</span>
		              <span>'.$getFromU->timeAgo($tweet->postedOn).'</span>
		            </div>
		            <div class="t-h-c-dis">
		              '.$getFromT->getTweetLinks($tweet->status).'
		            </div>
		          </div>
		        </div>'.
		        ((!empty($tweet->tweetImage)) ?
		         '<!--tweet show head end-->
		              <div class="t-show-body">
		                <div class="t-s-b-inner">
		                 <div class="t-s-b-inner-in">
		                   <img src="'.BASE_URL.$tweet->tweetImage.'" class="imagePopup" data-tweet="'.$tweet->tweetID.'"/>
		                 </div>
		                </div>
		              </div>
		              <!--tweet show body end-->
		        ' : '').'

		      </div>').'
		      <div class="t-show-footer">
		        <div class="t-s-f-right">
		          <ul>
		          '.(($getFromU->loggedIn() === true) ? '
		            <li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>
		            <li>'.(((isset($retweet['retweetID'])) ? $tweet->tweetID === $retweet['retweetID'] OR $user_id == $retweet['retweetBy'] : '') ? 
		            	'<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>' : 
		            	'<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>').'</li>
		           
		            <li>'.(((isset($likes['likeOn'])) ? $likes['likeOn'] === $tweet->tweetID : '') ? 
		            	'<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '' ).'</span></button>' : 
		            	'<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '' ).'</span></button>').'
		            </li>
		            
		            '.(($tweet->tweetBy === $user_id) ? '
		              <li>
			              <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
			              <ul>
			                <li><label class="deleteTweet" data-tweet="'.$tweet->tweetID.'">Delete Tweet</label></li>
			              </ul>
		              </li>' : '').'

		           ' : '<li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>
		                <li><button><i class="fa fa-retweet" aria-hidden="true"></i></button></li>
		                <li><button><i class="fa fa-heart" aria-hidden="true"></i></button></li>
		            ').'

		          </ul>
		        </div>
		      </div>
		    </div>
		    </div>
		    </div>';
  }
  ?>
	</div><!-- in left wrap-->
  <div class="popupTweet"></div>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/like.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/retweet.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/popuptweets.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/delete.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/comment.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/popupForm.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/fetch.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/search.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/hashtag.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/messages.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/postMessage.js"></script>

</div>
<!-- in center end -->

<div class="in-right">
	<div class="in-right-wrap">

		<!--==WHO TO FOLLOW==-->
	    <?php $getFromF->whoToFollow($user_id, $profileId); ?>
 		<!--==WHO TO FOLLOW==-->

		<!--==TRENDS==-->
   	   <?php $getFromT->trends(); ?>
 	 	<!--==TRENDS==-->

	</div><!-- in right wrap-->
</div>
 <!-- in right end -->
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/follow.js"></script>

		</div>
		<!--in full wrap end-->
	</div>
	<!-- in wrappper ends-->
 </div>
 <!-- ends wrapper -->
</body>
</html>
