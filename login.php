<?php
	
	//start session
	include('database.php');
	session_start();
	$conn = connect_db();

	//get username and password
	$username = $_POST["username"];
	$password = $_POST["password"];

	//hash password with hash and salt
	$hash_password = password_hash($password, PASSWORD_DEFAULT);


	//fetch username and password from db
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");


	//give me number of rows for result
	$num_of_rows = mysqli_num_rows($result);

	//check if user is in table and that password matches hash in db
	if($num_of_rows > 0 && password_verify($password, $hash_password)){

		$_SESSION["username"] = $username;
		header("Location: feed.php");

	}else{
		echo "invalid username or password";

	}
?>



