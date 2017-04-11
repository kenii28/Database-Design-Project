<html>
<?php
/*eventsearch.php
By Zami Talukder, Kenneth Huynh
Used to search for events through interest of the logged in individual
*/
include "startdatabase.php";



if(isset($_SESSION["username"]))
{
	//Asks the user to search for an event
	echo "The following events were organized by groups with similar to yours<br/>";
	if($findEvents = $mysqli->prepare("SELECT an_event.event_id, an_event.title, 
		an_event.description, an_event.start_time, an_event.location_name FROM interested_in,about,
		organize, an_event WHERE interested_in.username= ? AND interested_in.category = about.category 
		AND interested_in.keyword = about.keyword AND organize.group_id = about.group_id AND 
		organize.event_id = an_event.event_id"))
	{
		$findEvents->bind_param("s", $_SESSION["username"]);
		$findEvents->execute();
		$findEvents->bind_result($eventID, $eventTitle, $eventDesc, $eventStart, $eventLoc);
		echo "<table border = '1'>\n";
		echo "<tr> <td>EventID</td><td>Title</td><td>Description</td> <td>Start Time</td>
		<td>Location</td> </tr>\n";
		while($findEvents->fetch())
		{
			echo "<tr>";
			echo "<td>$eventID</td> <td>$eventTitle</td> <td>$eventDesc</td> <td>$eventStart</td> 
			<td>$eventLoc</td>";
			echo "</tr>\n";
		}
		echo "</table>\n";
		$findEvents->close();
			
	}
		
}
else
{
	echo "You must log in to search for events";
}

echo '<br /><a href="homepage.php">Go Back</a>';

?>
</html>