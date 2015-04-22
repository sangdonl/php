<!DOCTYPE html>
<?php
	session_start();
	include 'admin\menuItem.php'; 
	
	ini_set('session.gc_maxlifetime', 3600);
	

	

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

<html>
    <?php
		require_once("admin/header.php");
		getHeader();
	?>
            <div id="content" class="clearfix">
                <aside>
                        <h2><?php echo date("l"); ?>'s Special</h2>
                        <hr>
						<?php
							if(count($ListOfMenus) > 0) {
								
								//to change the menu item everyday
								$random_num = 0;
							
								if(isset($_SESSION["dayoftoday"])){
									if(isset($_SESSION["dayoftoday"]) == date("d")) //didn't change a day yet
										$random_num = $_SESSION["menuitem"];
									else { //changed a day
										$_SESSION["dayoftoday"] = date("d");
										$random_num = rand(0, count($ListOfMenus)-1);
										$_SESSION["menuitem"] = $random_num;								
									}
								}
								else {
									$_SESSION["dayoftoday"] = date("d");
									$random_num = rand(0, count($ListOfMenus)-1);
									$_SESSION["menuitem"] = $random_num;
								}
								echo "<img src=\"" . $ListOfMenus[$random_num]->getItemImage() . "\" alt=\"" . $ListOfMenus[$random_num]->getItemName() . "\" title=\"" . $ListOfMenus[$random_num]->getItemName() . "\" width=\"228\" height=\"153\">";
								echo "<h3>" . $ListOfMenus[$random_num]->getItemName() . "</h3>";
								echo "<p>" . $ListOfMenus[$random_num]->getDescription() . " - $" . $ListOfMenus[$random_num]->getPrice() . "</p>";
							
							}
						?>
                        
                </aside>
                <div class="main">
                    <h1>Welcome</h1>
                    <img src="images/dining_room.jpg" alt="Dining Room" title="Lee's Dining Room" class="content_pic">
                    <p>Opened in 1998, Lee's Restaurant is a Manhattan-style steakhouse with a genuine New York feel. Newly-renovated after over a decade of success, there's no doubt that the Grill is poised to remain a perpetual favourite. Priding itself on fabulous cuisine paired with top-quality customer service, Empire Grill provides a unique dining experience that keeps customers coming back again and again.</p>
                    <h2>Enomatic Wines</h2>
                    <p>Our Enomatic® dispenses wine directly from the bottle using Argon gas preservation. The Argon prevents the wines from oxidization, leaving the flavors and characteristics of the wine to remain intact for up to three weeks. This allows us to offer higher end wines by the glass as if the bottle had just been opened.  The portion control technology allows us pour by the oz and we simply break down the cost of the bottle so that you can have a glass of wine as large as you desire or just a sip to test the waters.</p>
                </div><!-- End Main -->
            </div><!-- End Content -->
    <?php
		require_once("admin/footer.php");
		getFooter();
	?>