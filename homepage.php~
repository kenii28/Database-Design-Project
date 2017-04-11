<html>
<title>Find yo Folks!</title>
<?php
/*homepage.php
By Zami Talukder, Kenneth Huynh
Php file for homepage of FindFolks
*/
include "startDatabase.php";

//puts links here
if(isset($_SESSION["username"])) {
	$date = date('Y-m-d'); //current date
	$currentDate = date('Y-m-d',strtotime($date. ' - 1 days')); //current date -1
	$inputTime = date('Y-m-d', strtotime($date. ' + 3 days')); // put the internal time plus 3 days here
	if ($stmt = $mysqli->prepare("SELECT event_id,title,description,start_time,location_name FROM an_event 
		WHERE CAST(start_time AS DATE) > ? AND CAST(start_time AS DATE) < ?")) {
        $stmt->bind_param("ss",$currentDate, $inputTime);
    
        $stmt->execute();
        $stmt->bind_result($event_id, $title, $description, $start_time, $location_name);
        
        echo "<table border = '1'>\n";
        echo "<tr> <td>Event ID</td><td>Title</td><td>Description</td><td>At</td><td>Location</td> </tr>\n";
        while ($stmt->fetch()) {
	        echo "<tr>";
            echo "<td>$event_id</td><td>$title</td><td>$description</td><td>$start_time</td><td>$location_name</td>";
	        echo "</tr>\n";
        }
        echo "</table>\n";
        $stmt->close();
    }
    echo '<a href="groupinterest.php">Click here to find a group of your interest</a><br/>';
    echo '<a href="loggedout.php">Click here to log out of your account</a><br/>';
    echo '<a href="eventsearch.php">Click here to search for events</a><br/>';
    echo '<a href="creategroup.php">Click here to create a group</a><br/>';
    echo '<a href="createinterest.php">Click here to create an interest</a><br/>';
    echo '<a href="friendevents.php">Click here to view upcoming events that friends are signed up for</a><br/>';
    echo '<a href="groupinfo.php">Click here to view information about all your groups</a><br/>';
    echo '<a href="addfriend.php">Click here to add friends</a><br/>';
    echo '<a href="eventmake.php">Click here to make an event</a><br/>';
    echo '<a href="myupcomingevents.php">Click here to view your upcoming events</a><br/>';
    echo '<a href="rate.php">Click here to rate an event</a><br/>';
    echo '<a href="seeaveragerating.php">Click here to see average event ratings</a><br/>';
}
else
{
	$date = date('Y-m-d'); //current date
	$currentDate = date('Y-m-d', strtotime($date. ' - 1 days')); //current date -1
	$inputTime = date('Y-m-d', strtotime($date. ' + 3 days')); // put the internal time plus 3 days here
	if ($stmt = $mysqli->prepare("SELECT event_id,title,description,start_time,location_name FROM an_event 
		WHERE CAST(start_time AS DATE) > ? AND CAST(start_time AS DATE) < ?")) {
		$stmt->bind_param("ss", $currentDate, $inputTime);
		
		$stmt->execute();
		$stmt->bind_result($event_id, $title, $description, $start_time, $location_name);
		echo "<table border = '1'>\n";
		echo "<tr> <td>Event ID</td><td>Title</td><td>Description</td><td>At</td><td>Location</td> </tr>\n"; 
		while ($stmt->fetch()) {
			echo "<tr>";
			echo "<td>$event_id</td><td>$title</td><td>$description</td><td>$start_time</td><td>$location_name</td>";
			echo "</tr>\n";
		}
		echo "</table>\n";
		$stmt->close();
	}
	echo '<a href="registration.php">Click here to register</a><br/>';
	echo '<a href="login.php">Click here to log into your account</a><br/>';
    echo '<a href="groupinterest.php">Click here to find a group of your interest</a><br/>';
}




?>
</html>

