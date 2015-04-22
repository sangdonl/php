<?php include 'AdminUser.php'; 
      include 'LeeDAO.php';?>
<!DOCTYPE html>
<html>
<HEAD>
	<TITLE>Sign in!</TITLE>
	<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<META http-equiv="Cache-Control" content="no-cache">
	<style> 
	#wrapper{
		background-color:#000000;
		color:#ffffff;
		border-style:solid;
		border-color:black;
		border-width:1px;
		width:500px;
		margin-left:auto;
		margin-right:auto;
		font-size: 14pt;
		text-align: center;

	}
	.content{
		color:#5450f7;
		font-size: 30px;
		font-weight: bold;
	}

	table
	{
		border:2;
		padding: 8;
		width:500px;
	}
</style>
</HEAD>
<body bgcolor=black>
<?php
	session_start();
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	//extract all field data of form
	extract($_POST);
		
	$login_error = "";
	$valid_data = true;
	if(isset($_POST["btnSubmit"])) {
		//validating the name data
		if($username == null) {
			$login_error = "Enter your username";
			$valid_data = false;
		}		
		else if($password == null) {
			$login_error = "Enter your password";
			$valid_data = false;
		}	
		if($valid_data == true) {
			$admin = new AdminUser($username, $password);
			if($admin->isAuthenticated()) {
				$_SESSION["admin_session"] = $admin;
				header("Location: admin_menu.php");
			}
			else {
				unset($_SESSION['admin_session']); 
				$login_error = "Your username is NOT registered or password is WRONG!";
			}		
		}
	}
?>

<div id="wrapper">
	<div style="color:#ffffff;font-size: 35px;">Sign in for an administrator area</div>
	<br><br>
	<?php echo "<div style=\"color:#ff5052;font-size: 15px;\">".$login_error."</div> <br>"; ?>
	
	<form name="frmLogin" id="frmLogin" method="post" action="login.php">
	<br>
		<table border="0">
			<tr>
				<td style="background-color:#c0c0c0;color:#444047;text-align: right;font-size: 20px;width:200px;">Username </td>
				<td style="text-align: left;"> &nbsp;<input type="text" name="username" id="username" size='30' value="<?php if(isset($btnSubmit)) echo $username; ?>"></td>
				
			</tr>
			<tr>
				<td style="background-color:#c0c0c0;color:#444047;text-align: right;font-size: 20px;">Password </td>
				<td style="text-align: left;"> &nbsp;<input type="password" name="password" id="password" size='30' value=""></td>
			</tr>
			<tr>
				<td colspan='2' style="height:70px;"><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign in!'> &nbsp; &nbsp;
				<input type='reset' name="btnReset" id="btnReset" value="Reset"></td>
			</tr>
		</table>
	</form>	
<?php
	require_once("footer.php");
	getFooter();
?>
