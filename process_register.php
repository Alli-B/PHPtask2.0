<?php 

session_start();

// print_r($_POST);

$errorcount = 0;

$first_name = $_POST['first_name'] != "" ? $_POST['first_name'] : $errorcount++;

$last_name = $_POST['last_name'] != "" ? $_POST['last_name'] : $errorcount++;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorcount++;
 
$password = $_POST['password'] != "" ? $_POST['password'] : $errorcount++;

$confirm_password = $_POST['c_password'] != "" ? $_POST['c_password'] : $errorcount++;

$designation = $_POST['designation'] != "" ? $_POST['designation'] : $errorcount++;

$gender = $_POST['gender'] != "" ? $_POST['gender'] : $errorcount++;

$_SESSION['first_name'] = $first_name;
 
if($errorcount > 0){
	$_SESSION["error"] = 'you have '. $errorcount . 'errors in your submission';
	header("Location: register.php?");

}else{

	$allUsers = scandir("db/users/"); 
	$countAllUsers = count($allUsers);

	$newUserId = $countAllUsers-1;

	$userObeject = [
		'id' =>$newUserId,
		'first_name' => $first_name,
		'last_name' => $last_name,
		'email' => $email,
		'gender' => $gender,
		'password' => password_hash($pa, PASSWORD_DEFAULT),
		'designation' => $designation,
	];

	for ($counter = 0; $counter < $countAllUsers; $counter++) {

		$currentUser = $allUsers[$counter];

		if ($currentUser == $email. ".json") {

			$_SESSION["error"] = "Registartion Failed!! User already exist ";
			header("Location: register.php");
			die();
			# code...
		}
	}

	file_put_contents("db/users/". $email . ".json",json_encode($userObeject));
	$_SESSION["message"] = "Thank you for a successfull registration!" . $first_name;
	header("Location: login.php");

}



 
?>