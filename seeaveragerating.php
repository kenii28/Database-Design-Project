<html>
<?php
//SELECT event_id, AVG(rating) FROM sign_up WHERE event_id in (SELECT an_event.event_id FROM an_event,organize,belongs_to WHERE belongs_to.username = 'zamms' && belongs_to.group_id=organize.group_id && organize.event_id = an_event.event_id AND CAST(end_time AS DATE) >= '2016-12-1' AND cast(end_time as date) <= '2016-12-10') GROUP BY event_id 
include "startDatabase.php";
if(isset($_SESSION["username"])) {
	if($averageRate = $mysqli->prepare("SELECT event_id, AVG(rating) 
		FROM sign_up WHERE event_id in 
		(SELECT an_event.event_id FROM an_event,organize,belongs_to 
		WHERE belongs_to.username = ? && belongs_to.group_id=organize.group_id 
		&& organize.event_id = an_event.event_id AND CAST(end_time AS DATE) <= ? 
		AND cast(end_time as date) >= ? ) GROUP BY event_id"))
	{
		$date = date('Y-m-d');
		$backDate = date('Y-m-d', strtotime($date. '-3 days'));
		$averageRate->bind_param("sss", $_SESSION["username"], $date, $backDate);
		$averageRate->execute();
		$averageRate->bind_result($eventID,$theRate);
		echo "<table border = '1'>\n";
		echo "<tr> <td>EventID</td> <td>Average Rating</td>  </tr>\n";
		while($averageRate->fetch())
		{
			echo "<tr>";
			echo "<td>$eventID</td><td>$theRate</td>";
			echo "</tr>\n";
		}
		echo "</table>\n";
		
	}
	else{
		echo "didnt work";
	}
	
}
else
{
	echo "You must log in to view this information";	
}


echo '<br/><a href="homepage.php">Go back</a>';
?>
</html>
