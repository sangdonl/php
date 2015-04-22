<!DOCTYPE html>
<html>
    <?php
		require_once("admin/header.php");
		getHeader();
		
		include 'admin\menuItem.php'; 
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		$link = mysqli_connect("127.0.0.1:3307", "admin", "admin", "leedb") or die("Error " . mysqli_error($link));
		$query = "SELECT * FROM menu_items order by itemName" ;
		
		$ListOfMenus = array();
		//execute the query
		$result = $link->query($query) or die("Error in the query.." . mysqli_error($link));	
		
		while ($row = mysqli_fetch_array($result)) {
			$menuItem = new menuItem("images/".$row['itemImage'], $row['itemName'], $row['itemDescription'], $row['itemPrice']); 
			array_push($ListOfMenus, $menuItem);	
		}
		mysqli_close($link);		
	?>
            <div id="content" class="clearfix">
          
			<table border="1">
	<?php
			if(count($ListOfMenus) == 0) {
				echo "<tr>";
				echo "<td colspan=\"2\"><h3>Coming Soon!!</h3></td>";
				echo "</td>";
			
			}
			else {		  
				for($i = 0 ;  $i < count($ListOfMenus) ; $i++) {
					if($i % 2 == 0) {
						echo "<tr>";
					}
					echo "<td style=\"text-align: center;width:50%;\"><img src=\"" . $ListOfMenus[$i]->getItemImage() . "\" alt=\"" . $ListOfMenus[$i]->getItemName() . "\" title=\"" . $ListOfMenus[$i]->getItemName() . "\" width=\"228\" height=\"153\">";
					echo "<h3>" . $ListOfMenus[$i]->getItemName() . "</h3>";
					echo $ListOfMenus[$i]->getDescription() . " - $" . $ListOfMenus[$i]->getPrice() . "</td>";
					if($i % 2 == 1 || $i == count($ListOfMenus)-1) {
						echo "</tr>";
					}	
				}		  
			}
	?>
			</table>
		  
            </div><!-- End Content -->
    <?php
		require_once("admin/footer.php");
		getFooter();
	?>