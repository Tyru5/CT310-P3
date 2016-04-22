<!DOCTYPE html>
<html>
  <head>
    <?php
      $debug = FALSE;
      // Setting the title for this page:
      $title = "Forgot Password";
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
            $heading = "Forgot Password";
            include "navbar.php"
            ?>

			<div class="forgot_password_heading">
				<h2>.:Enter in the email for instructions to be sent on how to reset your password:.</h2>
			</div>

            <div class="forgot_password_form">
            	<img id="forgot_password_pic" alt="we've all been there." src="assets/images/funny_password_pic.jpg">
            	<figcaption><a href="https://www.pinterest.com/MisterMeme/tech-memes/" target="_blank">Image Source</a></figcaption>
            	<form action="fmp.php" method="post" autocomplete="off">
            		<hr class="form_divs">
            		<div class="frmt_area">
            			Email: <input type="email" name="user_email">
            		</div>
					<hr class="form_divs">
					<input type="submit" value="Submit" name="send_reset_email">
            	</form>
            	<a href="login.php">Go Back</a>
            </div>

        </div>

        <?php
        	// ALL php code to encapsulate functionality above.
        	if( isset( $_POST['send_reset_email'] ) ){
        		// send the user the email --> sanitizing the input main!
        		$inputed_email = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL);
        		$_SESSION['inputed_email'] = $inputed_email;
        		$db->send_email($inputed_email);
        	}

        ?>

        <?php include 'footer.php'; ?>
    </body>
  </html>
