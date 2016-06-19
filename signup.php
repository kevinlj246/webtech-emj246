<?php
	include('database.php');
	include('functions.php');
	destroySession();

	//start session
	session_start();
	$conn = connect_db();

	//get username and password
	$username = $_POST["username"];
	$password = $_POST["password"];

	$hash_password = password_hash($password, PASSWORD_DEFAULT);

	$name = $_POST["name"];
	$email = $_POST["email"];
	$dob = $_POST["dob"];
	$gender = $_POST["gender"];
	$vq = $_POST["verification_question"];
	$va = $_POST["verification_answer"];
	$location = $_POST["location"];
	$profile_pic = $_POST["profile_pic"];

	sanitizeString($username);
	sanitizeString($name);
	sanitizeString($email);
	sanitizeString($dob);
	sanitizeString($gender);
	sanitizeString($vq);
	sanitizeString($va);
	sanitizeString($location);
	sanitizeString($profile_pic);


	//insert user info into db
	$result_insert = mysqli_query($conn, "INSERT INTO users(username, password, name, email, dob, gender, verification_question, verification_answer, location, profile_pic) VALUES ('$username', '$hash_password', '$name', '$email','$dob','$gender', '$vq', '$va', '$location', '$profile_pic')");

	//check if insert was okay
	if($result_insert){

		//redirect to feed page 
		header("Location: registered.php");

	}else{
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";
	}
?>