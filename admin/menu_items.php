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
	if(isset($_GET["delmenu"])) {
		$delmenu = $_GET["delmenu"];
		if($delmenu != null) {
			$sql = "DELETE FROM menu_items WHERE itemName='$delmenu'";

			if (!mysqli_query($link, $sql))
			{
				die('Error: ' . mysqli_error($con));
			}	
			else {
				//successfully delete
				echo "<div style=\"color:#5250ff;font-size: 18px;\">The menu item was successfully deleted.</div> <br>"; 				
			}			
		}	
	}
	
	$query = "SELECT * FROM menu_items order by itemName" ;
	
	//execute the query
	$result = $link->query($query) or die("Error in the query.." . mysqli_error($link));
	echo "<a href=\"menuadd.php\"> Add New Menu </a><br><br>";
	echo "<table border=\"1\">";
	echo "<tr><th colspan=\"5\" style=\"background-color:#909090;color:#141417;font-size: 16pt;\">Menu List</th></tr>";
	echo "<tr><th style=\"background-color:#c0c0c0;color:#444047;\">Menu Name</th><th style=\"background-color:#c0c0c0;color:#444047;\">Description</th><th style=\"background-color:#c0c0c0;color:#444047;\">Price</th><th style=\"background-color:#c0c0c0;color:#444047;\">Image Filename</th><th style=\"background-color:#c0c0c0;color:#444047;\">Delete</th></tr>";
	
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td style=\"color:#747077;\">".$row['itemName']."</td><td style=\"color:#747077;\">".$row['itemDescription']."</td><td style=\"color:#747077;\">".$row['itemPrice']."</td><td style=\"color:#747077;\">".$row['itemImage']."</td><td style=\"color:#747077;\"><a href=\"menu_items.php?delmenu=".$row['itemName']."\">Delete</a></td></tr>";
		
	}
	echo "</table>";
	mysqli_close($link);
?>

</div>
<?php
	require_once("footer.php");
	getFooter();
?>
