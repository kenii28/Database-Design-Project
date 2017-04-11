<html>
<title>Find yo Folks!</title>
<?php
/*friendevents.php
By Zami Talukder, Kenneth Huynh
Php file used to view all of the upcoming events for friends inside FindFolks
*/
include "startDatabase.php";

if(isset($_SESSION["username"])) {
	$date = date('Y-m-d'); //current date
	
	$stmt = $mysqli->prepare("SELECT * FROM an_event WHERE CAST(start_time AS DATE) > ?
		AND event_id in (SELECT event_id 
		FROM sign_up WHERE username in (SELECT friend_to FROM friend WHERE friend_of = ?))");
	$member = $_SESSION["username"];
	$stmt->bind_param("ss", $date, $member);
	$stmt->execute();
	$stmt->bind_result($event_id, $title, $description, $start_time, $end_time, $location_name, $zipcode);
	echo "<table border = '1'>\n";
        echo "<tr> <td>Event ID</td><td>Title</td><td>Description</td><td>Start</td><td>End</td><td>Location</td><td>Zipcode</td> </tr>\n";
        while ($stmt->fetch()) {
	        echo "<tr>";
            echo "<td>$event_id</td><td>$title</td><td>$description</td><td>$start_time</td><td>$end_time</td><td>$location_name</td><td>$zipcode</td>";
	        echo "</tr>\n";
        }
        echo "</table>\n";
	
	$stmt->close();
}
else
{
	echo "You must log in to view friend events";
}

echo '<br /><a href="homepage.php">Go Back</a>';

?>
</html>

