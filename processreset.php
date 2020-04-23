<?php 

session_start();

$errorcount = 0;

if (!$_SESSION['loggedin']) {
	

$token = $_POST['token'] != "" ? $_POST['token'] : $errorcount++;

$_SESSION['token'] = $token;
}

$email = $_POST['email'] != "" ? $_POST['email'] : $errorcount++;
 
$password = $_POST['password'] != "" ? $_POST['password'] : $errorcount++;


$_SESSION['email'] = $email;

if($errorcount > 0){
	$_SESSION["error"] = 'you have '. $errorcount . 'errors in your submission';
	header("Location: reset_password.php?");

	 

}else{


	$allUsersToken = scandir("db/token/"); 

	$countAllUsersToken = count($allUsersToken);

	for ($counter = 0; $counter  < $countAllUsersToken; $counter ++) { 
		# code...

		$currentTokenfile = $allUsersToken[$counter]; 
	
	if ($currentTokenfile == $email . ".json") {

			$tokenContent = file_get_contents("db/token/".$currentTokenfile);
			$tokenObject = json_decode($tokenContent);

			$tokenFromDB = $tokenObject->token;


			if($_SESSION['loggedin']){
				$checkToken = true;

			}else{
				$checkToken = $tokenFromDB == $token;


			}

			if ($checkToken){

				$allUsers = scandir("db/users/" . $currentUser); 
				$countAllUsers = count($allUsers);

				for ($counter = 0; $counter < $countAllUsers; $counter++) {

					$currentUser = $allUsers[$counter];
 
					if ($currentUser == $email. ".json") {

						$userString = file_get_contents("db/users/".$currentUser);
						$userObject = json_decode($userString);
						$userObject->password = password_hash($password, PASSWORD_DEFAULT);

						unlink("db/users/" . $currentUser);

						file_put_contents("db/users/". $email . ".json", json_encode($userObject));

						$_SESSION["message"] = "Password rest successful, you can now login";



						$subject = "Password Reset successful";
			$message = "The password associated with this account has on our platfrom has changed. if you did not initiate this change kindly visit our website to change your password immidiatly";
			$headers = "From: no-reply@sng.org" . "\r\n" . "CC: shehu@snh.org";

			file_put_contents("db/token/" . $email . ".json", json_encode(['token'=>$token]));

			$try = mail($email, $subject, $message, $headers);
						header("Location: login.php");

				}		
			}
			die();
		
		}



		}


	}

	$_SESSION["error"] = "Password rest failed expired token/email invalid";
	header("Location: reset_password.php");


}