<?php session_start();

$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION['email'] = $email;

if($errorCount > 0){

	$_SESSION["error"] = "You have " . $errorCount . " errors in your submission";
	header("Location: login.php");
}else{
	
	$allUsers = scandir("db/users/"); 
	$countAllUsers = count($allUsers);

	for ($counter = 0; $counter < $countAllUsers; $counter++) {

		$currentUser = $allUsers[$counter];
 
		if ($currentUser == $email. ".json") {

			$userString = file_get_contents("db/users/".$currentUser);
			$userObject = json_decode($userString);
			$passwordfronDB = $userObject->password;

			$passwordfronUser = password_verify($password, $passwordfronDB);

			
			if($passwordfronUser == $passwordfronDB){
				$_SESSION['loggedin'] = $userObject ->id;
				$_SESSION['email'] = $userObject ->email;
				$_SESSION['fullname'] = $userObject ->first_name. " " . $userObject->last_name;
				$_SESSION['role'] = $userObject ->designation;
				if ($_SESSION['role']  == 'Teller') {

					header("Location: teller.php");

					
						die();
					# code...
				}else{
					header('Location: customer_serv.php');
				}


				echo("in the dash");
				die();
			}

			$_SESSION["error"] = "Invalid email or password";
			header("Location: login.php");
			die();		
		}
	}  

	$_SESSION["error"] = "Invalid email or password";
	header("Location: login.php");
	die();
}


?>
