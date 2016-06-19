<?php

	include('database.php');

	//connect to db
	$conn = connect_db();

	//get data from form
	$PID = $_POST['PID'];

	//query db for this post
	$result = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$PID'");
	$row = mysqli_fetch_assoc($result);
	$likes = $row['likes'];

	//update likes
	$likes = $likes+1;

	$result = mysqli_query($conn, "UPDATE posts SET likes='$likes' WHERE id='$PID'");

	if($result){
		header("Location: feed.php");
	}else{
		echo "Error adding like!";
	}
?>