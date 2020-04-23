<?php session_start();

require_once('functions/alerts.php');


$errorCount = 0;
 
$email = $_POST['email'] != "" ? $_POST['email'] : $errorcount++;
$_SESSION['email'] = $email;

if($errorCount > 0){

	$session_error = "You have " . $errorCount . " error";
	
	if($errorCount > 1){

		$session_error .="s";
	}

	$session_error .= "in your form submission";
	set_alert('error', $session_error);

	header("Location: forgot_password.php");

}else{

	$allUsers = scandir("db/users/"); 
	$countAllUsers = count($allUsers);

	for ($counter = 0; $counter < $countAllUsers; $counter++) {

		$currentUser = $allUsers[$counter];

		if ($currentUser == $email. ".json") {

			 $token = "";

			 $alphabets = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
			 for ($i=0; $i < 20; $i++) {

			 	$index = mt_rand(0, count($alphabets)-1);

			 	$token .= $alphabets[$index];
			 }

			 
			$subject = "Password Reset";
			$message = "A password reset has been initiated on your account, if you did not iniitate this reset, please igore this message, otherwise, visit: localhost/phptask2/reset_password.php?token=" . $token;
			$headers = "From: no-reply@sng.org" . "\r\n" . "CC: shehu@snh.org";

			file_put_contents("db/token/" . $email . ".json", json_encode(['token'=>$token]));

			$try = mail($email, $subject, $message, $headers);

			if ($try){
				$_SESSION["error"] = "Password reset has been sent to: " . $email;
				header("Location: login.php");

			}else{

				$_SESSION["error"] = "Something went wrong we could not send a rest to: " . $email;
				header("Location: forgot_password.php");
			}


			die();

			// $_SESSION["error"] = "Sending Failed!! User does not exist ";
			// header("Location: forgot_password.php");
			// die();
			# code...
		}
	}

	$_SESSION["error"] = "Email not registered " . $email;
	header("Location: forgot_password.php"); 


}
?>