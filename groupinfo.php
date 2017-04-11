<html>
<title>Find yo Folks!</title>
<?php
/*groupinfo.php
By Zami Talukder, Kenneth Huynh
Php file used to view all of the info for all of the groups user created or belongs to inside FindFolks
*/
include "startDatabase.php";

if(isset($_SESSION["username"])) {
	echo '<br /><a>Groups that you created</a>';

	$stmt = $mysqli->prepare("SELECT * FROM a_group WHERE creator = ?");
	$creator = $_SESSION["username"];
	$stmt->bind_param("s", $creator);
	$stmt->execute();
	$stmt->bind_result($group_id, $group_name, $description, $creator);
	echo "<table border = '1'>\n";
        echo "<tr> <td>Group ID</td><td>Group Name</td><td>Description</td><td>Creator</td> </tr>\n";
        while ($stmt->fetch()) {
	        echo "<tr>";
            echo "<td>$group_id</td><td>$group_name</td><td>$description</td><td>
            $creator</td>";
	        echo "</tr>\n";
        }
        echo "</table>\n";
	
	$stmt->close();
	
	echo '<br /><a>Groups that you belong to</a>';
	$stmtt = $mysqli->prepare("SELECT * from a_group where group_id in 
		(SELECT group_id FROM `belongs_to` WHERE username = ?)");
	$user = $_SESSION["username"];
	$stmtt->bind_param("s", $user);
	$stmtt->execute();
	$stmtt->bind_result($group_id, $group_name, $description, $creator);
	echo "<table border = '1'>\n";
        echo "<tr> <td>Group ID</td><td>Group Name</td><td>Description</td><td>Creator</td> </tr>\n";
        while ($stmtt->fetch()) {
	        echo "<tr>";
            echo "<td>$group_id</td><td>$group_name</td><td>$description</td><td>
            $creator</td>";
	        echo "</tr>\n";
        }
        echo "</table>\n";
	
	$stmtt->close();
	
	//add the events of the groups
	///////////////////////////////////
	///////
	
	
	
	
	
}
else
{
	echo "You must log in to view group info";
}
echo '<br /><a href="homepage.php">Go Back</a>';

?>
</html>