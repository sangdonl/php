<!DOCTYPE html>
<html>
     <?php
		require_once("admin/header.php");
		getHeader();
	?>
            <div id="content" class="clearfix">
                <aside>
                        <h2>Mailing Address</h2>
                        <h3>4 Arbordale Cres<br>
                            Ottawa, ON K2G 5C6</h3>
                        <h2>Phone Number</h2>
                        <h3>(613)406-0792</h3>
                        <h2>Fax Number</h2>
                        <h3>(613)406-0792</h3>
                        <h2>Email Address</h2>
                        <h3>info@leefood.com</h3>
						<br><br><br>
                </aside>
                
				<?php
					//Used to throw mysqli_sql_exceptions for database
					//errors instead or printing them to the screen.
					mysqli_report(MYSQLI_REPORT_STRICT);
					
					//extract all field data of form
					extract($_POST);
					
					$registered = false;
					$valid_data = true;
					$name_error = "";
					$phone_error = "";
					$email_error = "";
					$refer_error = "";
					if(isset($btnSubmit)) {
						//connect DB
						$link = mysqli_connect("127.0.0.1:3307", "admin", "admin", "leedb") or die("Error " . mysqli_error($link));
						
						//validating the name data
						if($customerName == null) {
							$name_error = "Enter your name";
							$valid_data = false;
						}
						//validating the phone number
						if($phoneNumber == null) {
							$phone_error = "Enter your Phone number";
							$valid_data = false;
						}	
						//validating the phone number format
						else if(!preg_match("/^\(\d{3}\)\d{3}-\d{4}$/", $phoneNumber)) {
							$phone_error = "Invalid Phone number (000)000-0000";
							$valid_data = false;					
						}
						//validating the email data
						if($emailAddress == null) {
							$email_error = "Enter your Email";
							$valid_data = false;
						}	
						//validating the email format
						else {
							if(!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $emailAddress)) {
								$email_error = "Invalid Email address";
								$valid_data = false;					
							}	
							else {	
								//check duplicating of email
								if(isExistEmail()) {
									$email_error = "Your email already exists";
									$valid_data = false;
								}
							}	
						}
						if(!isset($referral)) {
							$refer_error = "Choose your reference";
							$valid_data = false;						
						}
						
						if($valid_data == true) {
							//insert data in the table
							$sql="INSERT INTO mailinglist (customerName, phoneNumber, emailAddress, referrer)	VALUES ('$customerName','$phoneNumber','$emailAddress','$referral')";

							if (!mysqli_query($link, $sql))
							{
								die('Error: ' . mysqli_error($con));
							}	
							else {
								//successfully insert
								echo "<h2>Thank you for your registration!!!</h2>";	
								$registered	= true;							
							}							
						}
					}
	
					function isExistEmail() {
						global $emailAddress;
						global $link;
				
						$query = "SELECT emailAddress FROM mailinglist where emailAddress='$emailAddress'" or die("Error in the consult.." . mysqli_error($link));

						//execute the query
						$result = $link->query($query);	
						if($result->num_rows > 0) {
							return true;
						}
						return false;			
					}				
				
				?>
				
				
					<div class="main" <?php if(isset($btnSubmit) && $registered) echo "style=\"visibility:hidden;\""; ?>>
                    <h1>Sign up for our newsletter</h1>
                    <p>Please fill out the following form to be kept up to date with news, specials, and promotions from the Lee's Restaurant!</p>
                    <form name="frmNewsletter" id="frmNewsletter" method="post" action="contact.php">
                        <table>
                            <tr>
                                <td>Name:</td>
                                <td><input type="text" name="customerName" id="customerName" size='30' value="<?php if(isset($btnSubmit)) echo $customerName; ?>"></td>
								<td><?php echo "<div style=\"color:#ff5052;font-size: 12px;\">".$name_error."</div>"; ?></td>
                            </tr>
                            <tr>
                                <td>Phone Number:</td>
                                <td><input type="text" name="phoneNumber" id="phoneNumber" size='30' value="<?php if(isset($btnSubmit)) echo $phoneNumber; ?>"></td>
								<td><?php echo "<div style=\"color:#ff5052;font-size: 12px;\">".$phone_error."</div>"; ?></td>
                            </tr>
                            <tr>
                                <td>Email Address:</td>
                                <td><input type="text" name="emailAddress" id="emailAddress" size='30' value="<?php if(isset($btnSubmit)) echo $emailAddress; ?>"></td>
								<td><?php echo "<div style=\"color:#ff5052;font-size: 12px;\">".$email_error."</div>"; ?></td>
                            </tr>
                            <tr>
                                <td>How did you hear<br> about us?</td>
                                <td>
									Newspaper<input type="radio" name="referral" id="referralNewspaper" value="newspaper" <?php if(isset($btnSubmit) && isset($referral) && $referral == "newspaper") echo "checked"; ?>>
                                    Radio<input type="radio" name='referral' id='referralRadio' value='radio' <?php if(isset($btnSubmit) && isset($referral) && $referral == "radio") echo "checked"; ?>>
                                    TV<input type='radio' name='referral' id='referralTV' value='TV' <?php if(isset($btnSubmit) && isset($referral) && $referral == "TV") echo "checked"; ?>>
                                    Other<input type='radio' name='referral' id='referralOther' value='other' <?php if(isset($btnSubmit) && isset($referral) && $referral == "other") echo "checked"; ?>>
								</td>
								<td><?php echo "<div style=\"color:#ff5052;font-size: 12px;\">".$refer_error."</div>"; ?></td>
                            </tr>
                            <tr>
                                <td colspan='3'><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form"></td>
                            </tr>
                        </table>
                    </form>	
                </div><!-- End Main -->
            </div><!-- End Content -->
    <?php
		require_once("admin/footer.php");
		getFooter();
	?>

