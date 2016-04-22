<!DOCTYPE html>
<html>
  <head>
    <?php
      $debug = FALSE;
      // Setting the title for this page:
      $title = "Password Reset";
      $session_name = "PetRescue_Malmstrom_Bertolacci"; // need to change this for the new project 2!
      include 'header.php';
      require_once( "assets/bcrypt/passwordLib.php" ); // for using the password_verify and password_hash functions.
      require_once 'lib/database.php'; // require all database code.
    ?>
  </head>
    <body>

		<!-- Setting up the connection with the database -->
		<?php $db = new database();?>

        <div class="pageContents">
            <?php
            // Setting the heading for the page:
            $heading = "Password Reset";
            include "navbar.php"
            ?>

			<div class="password_reset_form">
				<?php if( ($_SESSION['current_key']) == ($_GET['key']) ): ?>
				<form action="passwordreset.php?key=<?php echo $_SESSION['current_key'];?>" method="post">
					Password: <input type="password" name="new_password" size="26">
					<br>
					Confirm Password: <input type="password" name="confirm_new_password" size="20">
					<br>
					<input type="submit" value="Submit" name="submit_reset">
				</form>
				<?php endif; ?>
			</div>

			<?php
				// ALL functions for encapsulting the form above
			if( isset($_POST['submit_reset']) ){
				// 1) first --> wanna check that the user input the same password:
				if( (isset($_POST['new_password'])) && (isset($_POST['confirm_new_password'])) ){
					$newPass = filter_var($_POST['new_password'], FILTER_SANITIZE_STRING);
					$confirmNewPass = filter_var($_POST['confirm_new_password'], FILTER_SANITIZE_STRING);
					// echo "new pass: " . $newPass;
					// echo "<br>\n";
					// echo "confirm new pass: " . $confirmNewPass;
					// echo "<br> \n";
					// checking to see if the passwords match. If not, make them enter it in again.
					if($newPass != $confirmNewPass){
						echo "<p class=\"notification\">Passwords did not match, please enter them in again.</p> \n";
					}else{
						// the passwords matched and it is now time to update them:
						$newHash = password_hash($confirmNewPass, PASSWORD_BCRYPT);
						$db->update_password($_SESSION['inputed_email'], $newHash);
						echo "<script type='text/javascript'>setTimeout(\"location.href = 'login.php';\");</script>";
					}
				}
			}
			?>

        </div>
        <?php include 'footer.php'; ?>
    </body>
  </html>
