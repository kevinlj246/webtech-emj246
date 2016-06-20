<?php
	
	session_start();

	include('database.php');
	include('functions.php');

		//Get data from the form
	$comment = sanitizeString($_POST['comment']);
    $PID = sanitizeString($_POST['PID']);
    $username = sanitizeString($_POST['username']);

	//connect to DB
	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
	$row = mysqli_fetch_assoc($result);

	//Fetch User information	
	$name = sanitizeString($row["name"]);
	$UID = sanitizeString($row["id"]);

	$result_insert = mysqli_query($conn, "INSERT INTO comments(postID, comment, userID, nameOfUser) VALUES ('$PID', '$comment', $UID, '$name')");

	//check if insert was okay
	if($result_insert){

		//redirect to feed page 
		header("Location: feed.php");

	}else{
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";
	}
?>
