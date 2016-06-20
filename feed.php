<!DOCTYPE html>
<html>
<head>
	<title>MyFacebook Feed</title>
</head>
<body>
<?php
	include('database.php');
	
	session_start();
	$conn = connect_db();
	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	//user information 
	$row = mysqli_fetch_assoc($result);
	echo "<h1>Welcome back ".$row['name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";
	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content'>Say something...</textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<p><input type='submit'></p>";	
	echo "</form>";
	echo "<br>";

	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);

	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}

	//show all posts 
	for($i = 0; $i < $num_of_rows; $i++){
		$row = mysqli_fetch_row($result_posts);
		echo "$row[2] said $row[4] ($row[5])";
		echo "<form action='likes.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> <input type='submit' value='Like'></form>";

		$result_comments = mysqli_query($conn, "SELECT * FROM comments WHERE postID='$row[0]'");
		$num_of_rows2 = mysqli_num_rows($result_comments);
		//show comments
        if($num_of_rows2){
        	for($j =0; $j < $num_of_rows2; $j++){
            	$row2 = mysqli_fetch_row($result_comments);
			  	echo "&emsp;$row2[3] commented \"$row2[1]\" on $row2[4]<br>";
              	echo "<br>";
            }
        }else{
           	echo "No comments to show.";
            echo "<br>";
       	}
        echo "<form action='comments.php' method='POST'>";
        echo "<textarea name='comment'>Comment...</textarea>";
        echo "<input type='hidden' name='PID' value='$row[0]'>";
        echo "<input type='hidden' name='username' value='$username'>";
        echo "<input type='submit' value='Comment'></form>";
        echo "<br>";
	}
	echo '<a href="logout.php">Click here</a> to log out.';
?>
</body>
</html>
