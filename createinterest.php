<html>
<title>Find yo Folks!</title>
<?php
/*createinterest.php
By Zami Talukder, Kenneth Huynh
Php file used to create an interest inside FindFolks
*/

include "startDatabase.php"; //connects to database

if(isset($_SESSION["username"])) {
	echo "To create an interest, fill out the information below<br/>";
	echo '<form action="createinterest.php" method="POST">';
	
	echo "Interest Category<br/>";
	echo '<input type="text" name = "category"/><br/>';
	
	echo "Interest Keyword<br/>";
	echo '<input type="text" name = "keyword"/><br/>';
	echo '<input type="submit" value = "Submit"/>';
	
	echo '<br/><a href="homepage.php">Go back</a>';
	
	if(isset($_POST["category"]) && isset($_POST["keyword"])){
	//checks if all values are not empty
		if(empty($_POST["category"]) || empty($_POST["keyword"]))
		{
			echo "No fields can be empty<br/>";
			echo '<a href="createinterest.php">Click here to try again</a><br/>';
		}
		else
		{
			$interest = $mysqli->prepare("insert into interest values (?,?)");
			
			$interest->bind_param("ss", $_POST["category"], $_POST["keyword"]);
			$interest->execute();
			echo "You have successfully created an interest.<br/>";
			echo '<a href="homepage.php">Click here to return to homepage</a>';
			header("refresh: 3; homepage.php");
			
			$interest->close();
		}
	}
}



?>
</html>