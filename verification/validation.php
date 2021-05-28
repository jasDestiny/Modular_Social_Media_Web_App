<?php
	if(isset($_POST['next'])){
		$username = $getFromU->checkInput($_POST['username']);
	if (!empty($username)) {
	if(strlen($username) > 20){
		$error = "Username must be between in 6-20 characters";
	}else if(!preg_match('/^[a-zA-Z0-9]{6,}$/', $username)){
		$error = 'Username must be longer than 6 alphanumeric characters without any spaces';
	} else if($getFromU->checkUsername($username) === true){
		$error = "Username is already taken!";
	}else{
		$getFromU->update('users', $user_id, array('username' => $username));
		header('Location: signup.php?step=2');
	}
	}else{
		$error = "Please enter your username to choose";
	}
}
?>