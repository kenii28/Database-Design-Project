<html>
<title>Find yo Folks!</title>
<?php
/*addfriend.php
By Zami Talukder, Kenneth Huynh
Php file used to add a member as a friend inside FindFolks
*/
include "startDatabase.php";

if(isset($_SESSION["username"])) {
	echo "To add someone as a friend, enter their username below<br/>";
	echo '<form action="addfriend.php" method="POST">';
	
	echo "Friend's Username<br/>";
	echo '<input type="text" name = "name"/><br/>';
	
	echo '<input type="submit" value = "Submit"/>';
	echo '<br/><a href="homepage.php">Go back</a>';
	
	if(isset($_POST["name"])){
		if(empty($_POST["name"]))
		{
			echo "No fields can be empty<br/>";
			echo '<a href="addfriend.php">Click here to try again</a><br/>';
		}
		else{
			$add = $mysqli->prepare("insert into friend values (?,?)");
					
			$add->bind_param("ss", $_SESSION["username"], $_POST["name"]);
			$add->execute();
			$compare = gmp_cmp($add->affected_rows, "-1");
			if ($compare) {
				echo "You have successfully added your friend!<br/>";
				echo '<a href="homepage.php">Click here to return to homepage</a>';
			}
			else {
				echo "Invalid username or you are already friends<br/>";
			}
			
			$add->close();
			
			
			header("refresh: 3; homepage.php");
			
	}
			
}
}

?>
</html>