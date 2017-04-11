<html>
<?php

/*
by Zami Talukder, Kenneth Huynh
Rates an event, lets them know if they didnt attend
*/

include "startDatabase.php";
if(isset($_SESSION["username"]))
{
	if(isset($_POST["eventID"]) && isset($_POST["rating"]) 
		&& !empty($_POST["eventID"]) && !empty($_POST["rating"]))
	{
		if($rateEvent = $mysqli->prepare("update sign_up set rating = ?
			where username = ? and event_id = ?"))
		{
			$rateEvent->bind_param("sss", $_POST["rating"], $_SESSION["username"],
				$_POST["eventID"]);
			$rateEvent->execute();
			
			//uses this to compare numbers
			$compare = gmp_cmp($rateEvent->affected_rows,"0");
			if($compare)
			{
				echo "You have finished rating that event";
			}
			else{
				echo "<br/>Invalid event ID. Are you sure you signed up for that event?";
			}
		}
		
	}
	else
	{
		echo "Rate an event below<br/><br/>";
		echo "Input the exact event ID below";
		echo '<form action="rate.php" method="POST">';
		echo '<input type="text" name = "eventID"/><br/>';
		echo "<br/>Input the exact rating below. It can only be from 0-5<br/>";
		echo '<input type = "number" name="rating" min="1" max="5">';
		echo '<input type="submit" value = "Submit"/>';
	}
}
else
{
	echo "You must login to rate events";
	
}

echo '<br/><a href="homepage.php">Go back</a>';
?>
</html>