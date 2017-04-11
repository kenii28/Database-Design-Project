<html>
<title>Find yo Folks!</title>
<?php
/*creategroup.php
By Zami Talukder, Kenneth Huynh
Php file used to create a group into a_group inside FindFolks
*/

include "startDatabase.php"; //connects to database

if(isset($_SESSION["username"])) {
	echo "To create a group, fill out the information below<br/>";
	echo '<form action="creategroup.php" method="POST">';
	
	echo "Group Name<br/>";
	echo '<input type="text" name = "group_name"/><br/>';
	
	echo "Description<br/>";
	echo '<input type="text" name = "description"/><br/>';
	echo '<input type="submit" value = "Submit"/>';
	
	echo '<br/><a href="homepage.php">Go back</a>';
	if(isset($_POST["group_name"]) && isset($_POST["description"])){
	//checks if all values are not empty
		if(empty($_POST["group_name"]) || empty($_POST["description"]))
		{
			echo "No fields can be empty<br/>";
			echo '<a href="creategroup.php">Click here to try again</a><br/>';
		}
		else
		{
			//first checks if group is already made
			if($checkName = $mysqli->prepare("select group_name from a_group where group_name = ?"))
			{
				$checkName->bind_param("s", $_POST["group_name"]);
				$checkName->execute();
				$checkName->bind_result($group_name);
				if($checkName->fetch())
				{
					echo "Group name already exists. Please try again with a different group name. <br/>";
					echo "Wait 2 seconds or click ";
					echo '<a href="creategroup.php">here</a> to refresh';
					header("refresh: 2; creategroup.php");
					
				}
			
				else if($createGroup = $mysqli->prepare("insert into a_group (group_id, group_name, description,
					creator) values (null,?,?,?)"))
				{
					$creator = $_SESSION["username"];
					// $groupname = $_POST["group_name"];
					$createGroup->bind_param("sss", $_POST["group_name"], $_POST["description"], $creator);
					$createGroup->execute();
					$lastID = $createGroup->insert_id;
					$createGroup->close();
					
					
					$belongs_to = $mysqli->prepare("insert into belongs_to (group_id, username, authorized) 
						values (?,?,1)");
					
					$belongs_to->bind_param("ss", $lastID, $creator);
					$belongs_to->execute();
					$belongs_to->close();
					
					echo "You have successfully created a group.<br/>";
					echo '<a href="homepage.php">Click here to return to homepage</a>';
					header("refresh: 3; homepage.php");
				}
				$checkName->close();
			}
			
			}
	}
}

?>
</html>