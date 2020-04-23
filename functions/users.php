<?php

include_once('alerts.php');
 

function is_user_loggedin(){
	If($_SESSION['loggedin'] && !empty($_SESSION['loggedin'])){
		return true;
	}

	return false;
}

function is_token_set(){

	return is_token_set_in_get() || is_token_set_in_session();
}

function is_token_set_in_session(){

	return isset($_SESSION['token']);
}

function is_token_set_in_get(){

	return isset($_GET['token']);
}






function findUser($email = ""){

	if(!$email){

		setAlert('error', 'User Email is not set');
		die();
	}

	$allUsers = scandir("db/users/"); 
	$countAllUsers = count($allUsers);

	for ($counter = 0; $counter < $countAllUsers; $counter++) {

		$currentUser = $allUsers[$counter];
 
		if ($currentUser == $email. ".json") {

			$userString = file_get_contents("db/users/".$currentUser);
			$userObject = json_decode($userString);

			return $userObject;
			
		}	
		
	}

	return false;

}

function SaveUser($userObject){

	file_put_contents("db/users/". $userObject['email'] . ".json",json_encode($userObeject));
}
