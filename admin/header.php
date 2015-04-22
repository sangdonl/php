<?php
	function getHeader() {
		echo "<head>\n";
		echo "	<title>Lee's Restaurant - Home</title>\n";
		echo "	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n";
		echo "	<link href=\'http://fonts.googleapis.com/css?family=Fugaz+One|Muli|Open+Sans:400,700,800\' rel=\'stylesheet\' type=\'text/css\' />\n";
		echo "	<link href=\"css/style.css\" rel=\"stylesheet\" type=\"text/css\">\n";
		echo "</head>\n";
		echo "<body>\n";
		echo "	<div id=\"wrapper\">\n";
		echo "		<header class=\"clearfix\">\n";
		echo "			<img src=\"images/header_img.jpg\" alt=\"Dining Room\" title=\"Lee's Restaurant\"/>\n";
		echo "			<div id=\"title\">\n";
		echo "				<h1>Lee's Restaurant</h1>\n";
		echo "				<h2>4 Arbordale Cres, Ottawa ON</h2>\n";
		echo "				<h2>Tel: (613)406-0792</h2>\n";
		echo "			</div>\n";
		echo "		</header>\n";
		echo "		<nav>\n";
		echo "			<div id=\"menuItems\">\n";
		echo "				<ul>\n";
		echo "					<li><a href=\"index.php\">Home</a></li>\n";
		echo "					<li><a href=\"menu.php\">Menu</a></li>\n";
		echo "					<li><a href=\"contact.php\">Contact</a></li>\n";
		echo "					<li><a href=\"admin/login.php\">Admin</a></li>\n";
		echo "				</ul>\n";
		echo "			</div>\n";
		echo "		</nav>\n";	
	}
?>