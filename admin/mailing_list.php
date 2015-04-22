<?php
	require_once("admin_header.php");
	prepareLoad();
	getAdminHeader();
?>


<DIV align=center class=content>
<?php
	//Used to throw mysqli_sql_exceptions for database
	//errors instead or printing them to the screen.
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	$link = mysqli_connect("127.0.0.1:3307", "admin", "admin", "leedb") or die("Error " . mysqli_error($link));
	
	$query = "SELECT * FROM mailinglist" ;

	//execute the query
	$result = $link->query($query) or die("Error in the query.." . mysqli_error($link));
	
	echo "<table border=\"1\">";
	echo "<tr><th colspan=\"4\" style=\"background-color:#909090;color:#141417;font-size: 16pt;\">Members of Mailing list</th></tr>";
	echo "<tr><th style=\"background-color:#c0c0c0;color:#444047;\">Customer's Name</th><th style=\"background-color:#c0c0c0;color:#444047;\">Phone Number</th><th style=\"background-color:#c0c0c0;color:#444047;\">Email Address</th><th style=\"background-color:#c0c0c0;color:#444047;\">Reference</th></tr>";
	
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td>".$row['customerName']."</td><td>".$row['phoneNumber']."</td><td><a href=\"mailto:".$row['emailAddress']."\">".$row['emailAddress']."</a></td><td>".$row['referrer']."</td></tr>";
		
	}
	echo "</table>";
	mysqli_close($link);
	
?>

</div>
<?php
	require_once("footer.php");
	getFooter();
?>
