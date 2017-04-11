<html>
<?php
/*
By Zami Talukder, Kenneth Huynh
Makes an event and puts it in event and organize tables
*/

include "startdatabase.php";

echo "You may only make events for groups you are authorized by<br/>";

//checks if user is logged in
if(isset($_SESSION["username"]))
{
	if(isset($_POST["eventtitle"]) && isset($_POST["description"]) && isset($_POST["starttime"]) 
		&& isset($_POST["endtime"]) && isset($_POST["locName"]) && isset($_POST["zipcode"])
		&& isset($_POST["groups"]))
	{
		//converts time times
		$start = strtotime($_POST["starttime"].' UTC');
		$startdate = date("Y-m-d H:i:s", $start);
		
		$end = strtotime($_POST["endtime"].' UTC');
		$enddate = date("Y-m-d H:i:s", $end);
		
		
		//checks if title exists already
		if($lastCheck = $mysqli->prepare("SELECT title FROM an_event 
			WHERE title = ?"))
		{
			$lastCheck->bind_param("s",$_POST["eventtitle"]);
			$lastCheck->execute();
			$lastCheck->bind_result($theName);
			if($lastCheck->fetch())
			{
				echo "That event already exists";
				echo '<a href="homepage.php">Click here to go back</a>';
				header("refresh:2; homepage.php");
			}
			else if($createEvent = $mysqli->prepare("Insert into an_event values
				(null,?,?,?,?,?,?)"))
			{
				$createEvent->bind_param("ssssss",$_POST["eventtitle"],$_POST["description"],
					$startdate,$enddate,$_POST["locName"],$_POST["zipcode"]);
				$createEvent->execute();
				$eventID = $createEvent->insert_id;
				$createEvent->close();
				
				
				$createOrg = $mysqli->prepare("insert into organize values (?,?)");
				$createOrg->bind_param("ss",$eventID, $_POST["groups"]);
				if($createOrg->execute())  //if event was not created, because of mismatching location
				{
					echo "The event has been created";
				}
				else
				{
					echo "Mismatching location, try again";
					header("refresh:2; eventmake.php");
					
				}
			}
			
			
			
		}
	}
	//checks what groups user is authorized for
	else if($eventMake = $mysqli->prepare("SELECT a_group.group_id, a_group.group_name from a_group,belongs_to 
		WHERE belongs_to.username = ? AND belongs_to.authorized = 1 
		AND a_group.group_id = belongs_to.group_id"))
	{
		
		$eventMake->bind_param("s", $_SESSION["username"]);
		$eventMake->execute();
		$eventMake->bind_result($theGroupID, $theGroup);
		
		//whole bunch of inputs
		echo '<form action = "eventmake.php" method="POST">Choose a group<br>';
		echo '<select name="groups">';
		while($eventMake->fetch())
		{
			echo '<option value='.$theGroupID . ' ' . $theGroup.'>'; // does this to only get group id in post
			echo $theGroup;
			echo '</option>';
		}
		echo '</select>';
		$eventMake->close();
		
		// EVERYTHING FOR MAKING AN EVENT
		echo '<br/>';
		echo "Enter the information below to make an event</br>";
		echo "Title<br/>";
		echo '<input type="text" name = "eventtitle"/><br/>';
		echo "Description<br/>";
		echo '<input type="text" name = "description"/><br/>';
		echo "Start Time<br/>";
		echo '<input type="datetime-local" name = "starttime"/><br/>';
		echo "End Time<br/>";
		echo '<input type="datetime-local" name = "endtime"/><br/>';
		$locations = $mysqli->prepare("select location_name from location");
		$locations->execute();
		$locations->bind_result($locName);
		echo "Location<br/>";
		echo '<select name = "locName">'; 
		while($locations->fetch())
		{
			echo '<option value="'.$locName.'">';
			echo $locName;
			echo '</option>';
		}
		echo '</select>';
		
		$zip = $mysqli->prepare("select zipcode from location");
		$zip->execute();
		$zip->bind_result($zipcode);
		echo "</br>Zipcode<br/>";
		echo '<select name = "zipcode">'; 
		while($zip->fetch())
		{
			echo '<option value="'.$zipcode.'">';
			echo $zipcode;
			echo '</option>';
		}
		echo '</select>';
		echo '<br/><input type="submit" value = "Submit"/>';
		echo '</form>';
		$locations->close();
		$zip->close();
	}
	
	
}
else
{
	echo "You must be logged in to create an event<br/>";
}

echo '<br/><a href="homepage.php">Go back</a>';

?>
</html>