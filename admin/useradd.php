<?php
	require_once("admin_header.php");
	prepareLoad();
	getAdminHeader();
?>


<DIV align=center class=content>

<?php
	$admin = $_SESSION["admin_session"];
	
	//extract all field data of form
	extract($_POST);	
	
	$login_error = "";
	$registered = false;
	$valid_data = true;
	if(isset($_POST["btnSubmit"])) {
		//validating the name data
		if($username == null) {
			$login_error = "Enter your username";
			$valid_data = false;
		}		
		else if($password == null || $confirm_password == null) {
			$login_error = "Enter your password";
			$valid_data = false;
		}	
		else if($password != $confirm_password) {
			$login_error = "Password does not match the confirm password.";
			$valid_data = false;			
		}
		else if($lastname == null) {
			$login_error = "Enter your last name";
			$valid_data = false;
		}	
		else if($firstname == null) {
			$login_error = "Enter your first name";
			$valid_data = false;
		}			
		if($valid_data == true) {
			if(!CheckDuplicateUsername($username)) {
				$link = mysqli_connect("127.0.0.1:3307", "admin", "admin", "leedb") or die("Error " . mysqli_error($link));
				$sql = "INSERT INTO authorized_users (firstName, lastName, username, password) VALUES ('$firstname','$lastname','$username','$password')";

				if (!mysqli_query($link, $sql))
				{
					$login_error = "Error: "+mysqli_error($link);
					$valid_data = false;
				}	
				else {
					//successfully insert
					$login_error = "The new user was successfully created.";
					$registered	= true;							
				}						
			}
			else {
				$login_error = "Username already exists";
				$valid_data = false;
			}	
		}	
	}
	
	//check entered username
	function CheckDuplicateUsername($username) {
		$link = mysqli_connect("127.0.0.1:3307", "admin", "admin", "leedb") or die("Error " . mysqli_error($link));
		
		$query = "SELECT username FROM authorized_users where username='$username'" ;	
		$result = $link->query($query) or die("Error in the query.." . mysqli_error($link));
		if($result->num_rows > 0) {
			mysqli_close($link);	
			
			return true;
		}
		mysqli_close($link);
		
		return false;
	}
?>
	<?php 
		if($login_error != null && $registered	== false) //display error message
			echo "<div style=\"color:#ff5052;font-size: 16px;\">".$login_error."</div> <br>"; 
		else //display welcome message
			echo "<div style=\"color:#5250ff;font-size: 18px;\">".$login_error."</div> <br>"; 
	?>
	
	<form method="post" action="useradd.php">
		<table border="0">
		<tr>
			<th colspan="2" style="background-color:#909090;color:#141417;font-size: 16pt;">Add New Account</th>
		</tr>	
		<tr>
			<td style="background-color:#c0c0c0;color:#444047;text-align: right;height:30px;">Username</td>
			<td style="text-align: left;"><input type="text" name="username" id="username" size='30' value="<?php if(isset($btnSubmit) && !$registered) echo $username; ?>"></td>
		</tr>
		<tr>
			<td style="background-color:#c0c0c0;color:#444047;text-align: right;height:30px;">Passsword</td>
			<td style="text-align: left;"><input type="password" name="password" id="password" size='30' value=""></td>
		</tr>		
		<tr>
			<td style="background-color:#c0c0c0;color:#444047;text-align: right;height:30px;">Confirm Passsword</td>
			<td style="text-align: left;"><input type="password" name="confirm_password" id="confirm_password" size='30' value=""></td>
		</tr>	
		<tr>
			<td colspan=2></td>
		</tr>	
		<tr>
			<td style="background-color:#c0c0c0;color:#444047;text-align: right;height:30px;">First Name</td>
			<td style="text-align: left;"><input type="text" name="firstname" id="firstname" size='40' value="<?php if(isset($btnSubmit) && !$registered) echo $firstname; ?>"></td>
		</tr>			
		<tr>
			<td style="background-color:#c0c0c0;color:#444047;text-align: right;height:30px;">Last Name</td>
			<td style="text-align: left;"><input type="text" name="lastname" id="lastname" size='40' value="<?php if(isset($btnSubmit) && !$registered) echo $lastname; ?>"></td>
		</tr>		
		<tr>
			<td colspan='2' style="height:50px;"><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'> &nbsp; &nbsp; &nbsp; &nbsp;
			<input type='reset' name="btnReset" id="btnReset" value="Reset"></td>
		</tr>		
		</table>
	</form>
</div>
<?php
	require_once("footer.php");
	getFooter();
?>
