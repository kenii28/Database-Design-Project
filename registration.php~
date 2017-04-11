
<html>
<title>Find yo Folks!</title>
<?php
/*registration.php
By Zami Talukder, Kenneth Huynh
Php file used to register a user into member inside FindFolks
*/

include "startDatabase.php"; //connects to database

//checks if user is already logged in, returns them back if they are
if(isset($_SESSION["username"])) {
	echo "You are already logged in. You will be redirected in 2 seconds.";
	echo '<br/> <a href="homepage.php">Click here to return to homepage</a>';
	header("refresh: 3; homepage.php");
}
//checks if all values have been set
else if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["firstname"])
	&& isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["zipcode"]))  
{
	//checks if all values are not empty
	if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["firstname"])
		|| empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["zipcode"]))
	{
		echo "No fields can be empty<br/>";
		echo '<a href="registration.php">Click here to try again</a><br/>';
	}
	else
	{
		//first checks if username is already made
		if($checkName = $mysqli->prepare("select username from member where username = ?"))
		{
			$checkName->bind_param("s", $_POST["username"]);
			$checkName->execute();
			$checkName->bind_result($username);
			if($checkName->fetch())
			{
				echo "Username already exists. Please try again with a different username. <br/>";
				echo "Wait 2 seconds or click ";
				echo '<a href="registration.php">here</a> to refresh';
				header("refresh: 2; registration.php");
				
			}
			//registers if its not a username in use
			else if($toRegister = $mysqli->prepare("insert into member values (?,?,?,?,?,?)"))
			{
				$zipcode = (int)$_POST["zipcode"];
				$pword = md5($_POST["password"]);
				$toRegister->bind_param("sssssi", $_POST["username"], $pword,
					$_POST["firstname"], $_POST["lastname"], $_POST["email"],$zipcode);
				$toRegister->execute();
				$toRegister->close();
				echo "You have successfully registered.<br/>";
				echo '<a href="homepage.php">Click here to return to homepage</a>';
			}
			$checkName->close();
		}
		
	}
}
else{
	//Asks for registration info and registers a user
	echo "To register, fill out the information below<br/>";
	echo "Username<br/>";
	echo '<form action="registration.php" method="POST">';
	echo '<input type="text" name = "username"/><br/>';
	
	echo "Password<br/>";
	echo '<input type="password" name = "password"/><br/>';
	
	echo "First Name<br/>";
	echo '<input type="text" name = "firstname"/><br/>';
	
	echo "Last Name<br/>";
	echo '<input type="text" name = "lastname"/><br/>';
	
	echo "Email<br/>";
	echo '<input type="text" name = "email"/><br/>';
	
	echo "Zipcode<br/>";
	echo '<input type="text" name = "zipcode"/><br/>';
	
	echo '<input type="submit" value = "Submit"/>';
	
	echo '<br/><a href="homepage.php">Go back</a>';
}

?>
</html>