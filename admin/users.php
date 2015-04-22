<?php
	require_once("admin_header.php");
	prepareLoad();
	getAdminHeader();
?>


<DIV align=center class=content>
<?php
	$admin = $_SESSION["admin_session"];
	
	$link = mysqli_connect("127.0.0.1:3307", "admin", "admin", "leedb") or die("Error " . mysqli_error($link));
	
	
	//delete user account
	$result_msg = null;
	if(isset($_GET["deluser"])) {
		$deluser = $_GET["deluser"];
		if($deluser != null) {
			$sql = "DELETE FROM authorized_users WHERE username='$deluser'";

			if (!mysqli_query($link, $sql))
			{
				die('Error: ' . mysqli_error($con));
			}	
			else {
				//successfully delete
				echo "<div style=\"color:#5250ff;font-size: 18px;\">The user was successfully deleted.</div> <br>"; 				
			}			
		}	
	}
	
	$query = "SELECT * FROM authorized_users order by lastName" ;
	
	//execute the query
	$result = $link->query($query) or die("Error in the query.." . mysqli_error($link));
	echo "<a href=\"useradd.php\"> Add New Account </a><br><br>";
	echo "<table border=\"1\">";
	echo "<tr><th colspan=\"4\" style=\"background-color:#909090;color:#141417;font-size: 16pt;\">User List</th></tr>";
	echo "<tr><th style=\"background-color:#c0c0c0;color:#444047;\">Username</th><th style=\"background-color:#c0c0c0;color:#444047;\">Last Name</th><th style=\"background-color:#c0c0c0;color:#444047;\">First Name</th><th style=\"background-color:#c0c0c0;color:#444047;\">Delete</th></tr>";
	
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td style=\"color:#747077;\">".$row['username']."</td><td style=\"color:#747077;\">".$row['lastName']."</td><td style=\"color:#747077;\">".$row['firstName']."</td>";
		if($admin->getUsername() == 'admin') {
			if($row['username'] != 'admin')
				echo "<td><a href=\"users.php?deluser=".$row['username']."\">Delete</a></td></tr>";
			else
				echo "<td style=\"color:#747077;\">x</td></tr>";
		}
		else
			echo "<td style=\"color:#747077;\">x</td></tr>";
		
	}
	echo "</table>";
	mysqli_close($link);

	
?>

</div>
<?php
	require_once("footer.php");
	getFooter();
?>
