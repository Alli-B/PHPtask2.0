<?php 

session_start();

require_once('functions/users.php');

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
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['designation'] = $designation;
$_SESSION['gender'] = $gender;

if (preg_match('/[\'1234567890^£"$%&*()}{@#~?><>,|=_+¬-]/', $first_name)) {

      $_SESSION["fname"] = "First name cannot have numbers or special characters";
			header("Location: register.php");

		}else{
			if (preg_match('/[\'1234567890^£"$%&*()}{@#~?><>,|=_+¬-]/', $last_name)) {

      $_SESSION["lname"] = "last name cannot harve numbers or special characters";
			header("Location: register.php");

		}else{


     
 
if($errorcount > 0){
	$_SESSION["error"] = 'you have '. $errorcount . 'errors in your submission';
	header("Location: register.php?");

	 

}else{

	
	$newUserId = ($countAllUsers-1);

	$userObject = [
		'id' =>$newUserId,
		'first_name' => $first_name,
		'last_name' => $last_name,
		'email' => $email,
		'gender' => $gender,
		'password' => password_hash($password, PASSWORD_DEFAULT),
		'designation' => $designation,
	];

	$userExist = findUser($email);
	

		if (userExist) {

			$_SESSION["error"] = "Registartion Failed!! User already exist ";
			header("Location: register.php");
			die();
			# code...
		}
	}


	saveUser($userObject);
	
	$_SESSION["message"] = "Thank you for a successfull registration!" . $first_name;
	header("Location: login.php");

}
}


 
?>