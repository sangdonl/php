<?php 
function prepareLoad() {
	include 'AdminUser.php'; 
    include 'LeeDAO.php';

	session_start();
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	$admin = null;
	if(isset($_SESSION["admin_session"])){
		$admin = $_SESSION["admin_session"];

		if(!$admin->isAuthenticated()) {
			header("Location: login.php");
			exit;	
		}
	}
	else {
		header("Location: login.php");
		exit;
	}
}

function getAdminHeader() {
	echo "<!DOCTYPE html>\n";
	echo "<html>\n";
	echo "<HEAD>\n";
	echo "	<TITLE>Administrator Menu</TITLE>\n";
	echo "	<META http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n";
	echo "	<META http-equiv=\"Cache-Control\" content=\"no-cache\">\n";
	echo "	<style> \n";
	echo "	#wrapper{\n";
	echo "		background-color:#000000;\n";
	echo "		color:#ffffff;\n";
	echo "		border-style:solid;\n";
	echo "		border-color:black;\n";
	echo "		border-width:1px;\n";
	echo "		width:600px;\n";
	echo "		margin-left:auto;\n";
	echo "		margin-right:auto;\n";
	echo "		font-size: 13pt;\n";
	echo "		text-align: center;\n";
	echo "	}\n";
	echo ".content{\n";
	echo "	color:#9490f7;\n";
	echo "	font-size: 15px;\n";
	echo "	font-weight: bold;\n";
	echo "}\n";
	echo "	table\n";
	echo "	{\n";
	echo "		border:2;\n";
	echo "		padding: 8;\n";
	echo "		width:600px;\n";
	echo "	}\n";
	echo "</style>\n";
	echo "</HEAD>\n";
	echo "<body bgcolor=black>\n";
	echo "	<div id=\"wrapper\">\n";
	echo "	<h1>Menu for Administrator</h1>\n";
	echo "	<table>\n";
	echo "		<tr>\n";
	echo "			<th><a href=\"users.php\"> User List </a></th>\n";
	echo "			<th><a href=\"menu_items.php\"> Menu List </a></th>\n";
	echo "			<th><a href=\"mailing_list.php\">Mailing List</a></th>\n";
	echo "			<th><a href=\"logout.php\">Logout</a></th>\n";
	echo "			<th><a href=\"..\index.php\">Home</a></th>\n";	
	echo "		</tr>\n";
	echo "	</table>\n";
	echo "  <br>\n";
			

}
?>