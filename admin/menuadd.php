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
	
	$filename = null;
	if(isset($_POST["btnSubmit"])) {
		//validating the name data
		if($menuname == null) {
			$login_error = "Enter the Menu name";
			$valid_data = false;
		}		
		else if($description == null) {
			$login_error = "Enter the Menu description";
			$valid_data = false;
		}	
		else if($itemprice == null) {
			$login_error = "Enter the Menu price";
			$valid_data = false;
		}	
		else if(is_numeric($itemprice) == null) {
			$login_error = "Enter the number only";
			$valid_data = false;
		}	
		else if($_FILES['imagefile']['name'] !=""){
			$filename = $_FILES['imagefile']['name'];
			$filetype = $_FILES['imagefile']['type'];
			$filesize = $_FILES['imagefile']['size'];
			
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $filename);
			$extension = end($temp);
			if ((($filetype == "image/gif") || ($filetype == "image/jpeg") || ($filetype == "image/jpg")
				|| ($filetype == "image/pjpeg") || ($filetype == "image/x-png") || ($filetype == "image/png"))
				&& ($filesize < 2000000) && in_array($extension, $allowedExts))
			{			
				$target_path = "../images/";
			
				$target_path = $target_path . basename($filename); 
				move_uploaded_file($_FILES['imagefile']['tmp_name'], $target_path);	
			}
			else {
				$login_error = "Invalid image type. Please try again with image(GIF,JPG,PNG) and less than 2Mbytes";
				$valid_data = false;					
			}
		}			
		if($valid_data == true) {

			$link = mysqli_connect("127.0.0.1:3307", "admin", "admin", "leedb") or die("Error " . mysqli_error($link));

			$message = mysqli_real_escape_string( $link, strip_tags(trim( $description )) ) ;
			
			$sql = "INSERT INTO menu_items (itemName, itemDescription, itemPrice, itemImage) VALUES ('$menuname','$message',$itemprice,'$filename')";

			if (!mysqli_query($link, $sql))
			{
				$login_error = "Error: " . mysqli_error($link);
				$valid_data = false;
			}	
			else {
		
				//successfully insert
				$login_error = "The new menu was successfully created.";
				$registered	= true;							
			}						
		}	
	}
	
?>
	<?php 
		if($login_error != null && $registered	== false) //display error message
			echo "<div style=\"color:#ff5052;font-size: 16px;\">".$login_error."</div> <br>"; 
		else //display welcome message
			echo "<div style=\"color:#5250ff;font-size: 18px;\">".$login_error."</div> <br>"; 
	?>
	
	<form method="post" action="menuadd.php" enctype="multipart/form-data">
		<table border="0">
		<tr>
			<th colspan="2" style="background-color:#909090;color:#141417;font-size: 16pt;">Add New Menu</th>
		</tr>	
		<tr>
			<td style="background-color:#c0c0c0;color:#444047;text-align: right;height:30px;width:130px;">Menu Name</td>
			<td style="text-align: left;"><input type="text" name="menuname" id="menuname" size='60' value="<?php if(isset($btnSubmit) && !$registered) echo $menuname; ?>"></td>
		</tr>	
		<tr>
			<td style="background-color:#c0c0c0;color:#444047;text-align: right;height:30px;">Description</td>
			<td style="text-align: left;"><textarea name="description" id="description" rows='8' cols='55'><?php if(isset($btnSubmit) && !$registered) echo htmlspecialchars($description); ?></textarea></td>
		</tr>			
		<tr>
			<td style="background-color:#c0c0c0;color:#444047;text-align: right;height:30px;">Price</td>
			<td style="text-align: left;"><input type="text" name="itemprice" id="itemprice" size='30' value="<?php if(isset($btnSubmit) && !$registered) echo $itemprice; ?>"></td>
		</tr>		
		<tr>
			<td style="background-color:#c0c0c0;color:#444047;text-align: right;height:30px;">Image File</td>
			<td style="text-align: left;"><input type="file" name="imagefile" id="imagefile" size="50"></td>
		</tr>		
		<tr>
			<td colspan='2' style="height:50px;"><input type='submit' name='btnSubmit' id='btnSubmit' value='Add Menu'> &nbsp; &nbsp; &nbsp; &nbsp;
			<input type='reset' name="btnReset" id="btnReset" value="Reset"></td>
		</tr>		
		</table>
	</form>
</div>
<?php
	require_once("footer.php");
	getFooter();
?>
