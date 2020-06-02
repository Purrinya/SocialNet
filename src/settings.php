<?php 
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");
?>

<div class="main_column column" id="setting-box">

	<h4 style="text-align: center; color: #1a72ff;">Account Settings</h4>
	<?php
	echo "<div class='user_details_avatar'><img src='" . $user['profile_pic'] ."' class='small_profile_pic'></div>";
	?>
	<br>
	<a href="upload.php">Upload new profile picture</a> <br><br>

	<span style="font-weight: bold;">MODIFY THE VALUES AND CLICK "UPDATE DETAILS"</span>
	<br><br>
	<?php
	$user_data_query = mysqli_query($con, "SELECT first_name, last_name, email FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($user_data_query);

	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$email = $row['email'];
	?>

	<form action="settings.php" method="POST">
		First Name: <input type="text" name="first_name" value="<?php echo $first_name; ?>" id="settings_input"><br>
		Last Name: <input type="text" name="last_name" value="<?php echo $last_name; ?>" id="settings_input"><br>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: <input type="text" name="email" value="<?php echo $email; ?>" id="settings_input"><br>

		<?php echo $message; ?>

		<input type="submit" name="update_details" id="save_details" value="Update Details" class="info settings_submit"><br>
	</form>

	<br>
	<h4>Change Password</h4>
	<form action="settings.php" method="POST">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Old Password: <input type="password" name="old_password" id="settings_input"><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Password: <input type="password" name="new_password_1" id="settings_input"><br>
		New Password Again: <input type="password" name="new_password_2" id="settings_input"><br>

		<?php echo $password_message; ?>

		<input type="submit" name="update_password" id="save_details" value="Update Password" class="info settings_submit"><br>
	</form>

	<br>
	<h4>Close Account</h4>
	<form action="settings.php" method="POST">
		<input type="submit" name="close_account" id="close_account" value="Close Account" class="danger settings_submit">
	</form>


</div>