<html>
<title>Logout</title>
<?php
session_start();
session_destroy();
echo "You have logged out.";
echo '<a href="homepage.php">You will be moved back to the homepage or click here</a>';
header("refresh: 3; homepage.php");
?>
</html>