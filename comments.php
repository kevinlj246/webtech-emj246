<?php
	
	session_start();

	include('database.php');
	include('functions.php');

		//Get data from the form
	$comment = $_POST['comment'];
	$UID = $_POST['UID'];
	$PID = $_POST['PID'];

	//connect to DB
	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");
	$row = mysqli_fetch_assoc($result);

	$result2 = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$PID'");
	$row2 = mysqli_fetch_assoc($result2);



	//Fetch User information	
	$name = $row["name"];
	$postID = $row2["postID"];
	sanitizeString($comment);



	$result_insert = mysqli_query($conn, "INSERT INTO comments(postID, comment, userID, nameOfUser) VALUES ('$postID', '$comment', $UID, '$name')");

	//check if insert was okay
	if($result_insert){

		//redirect to feed page 
		header("Location: feed.php");

	}else{
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";

	}
?>