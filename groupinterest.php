<html>
<?php
/*groupinterest.php
By Zami Talukder, Kenneth Huynh
Used to search for a group using an interest. 
Logged in users may also join groups by providing the group id
*/

include "startdatabase.php";

//Asks the user to search for a group
echo "To search, enter a keyword in the search bar and click search";
echo '<form action= "groupinterest.php" method = "POST">';
echo '<input type ="text" name = "interest"/><br/>';
echo '<input type ="submit" value = "Search"/><br/>';


//first checks if the fields are filled out
if(isset($_POST["interest"]) && !empty($_POST["interest"]))
{
	if($findGroups = $mysqli->prepare("SELECT a_group.group_id, a_group.group_name, a_group.description FROM a_group, about 
		WHERE about.keyword LIKE ? AND about.group_id = a_group.group_id"))
	{
		$interest = "%{$_POST["interest"]}%";
		$findGroups->bind_param("s", $interest);
		$findGroups->execute();
		$findGroups->bind_result($groupID, $groupName, $groupDescription);
		echo "<table border = '4'>\n";
		echo "<tr> <td>GroupID</td> <td>Group Name</td> <td>Description</td> </tr>";
		while($findGroups->fetch())
		{
			echo "<tr>";
			echo "<td>$groupID</td><td>$groupName</td><td>$groupDescription</td>";
			echo "</tr>\n";
		}
		echo "</table>\n";
		$findGroups->close();
	}
}

//first checks if the user is logged in
if(isset($_SESSION["username"]))
{
	echo '<br/>';
	echo "To join a group enter the exact GroupID below and press submit.<br/>";
	echo '<form action= "groupinterest.php" method = "POST">';
	echo '<input type ="text" name = "joingroup"/><br/>';
	echo '<input type ="submit" value = "Submit"/><br/>';
	//checks if groupname is filled out
	if(isset($_POST["joingroup"]) && !empty($_POST["joingroup"])) 
	{
		if($joinGroup = $mysqli->prepare("insert into belongs_to values (?,?,0)"))
		{
			$joinGroup->bind_param("ss",$_POST["joingroup"], $_SESSION["username"]);
			//checks if groupname was valid since it wont run otherwise
			if($joinGroup->execute())
			{
				echo $_SESSION["username"];
				echo " has joined the group with ID ";
				echo $_POST["joingroup"];
			}
			else{
				echo "Invalid GroupID or you are already part of that group";	
			}
			$joinGroup->close();
		}
	}
}
else
{
	echo "You must be logged in to join a group. <br/>";
}


echo '<br /><a href="homepage.php">Go back</a>';


?>
</html>