<!DOCTYPE html>
<html>
  <head>
    <?php
      $debug = FALSE;
      // Setting the title for this page:
      $title = "Create Account";
      $session_name = "PetRescue_Malmstrom_Bertolacci"; // need to change this for the new project 2!
      include 'header.php';
      require_once( "assets/bcrypt/passwordLib.php" ); // for using the password_verify and password_hash functions.
    ?>
  </head>
    <body>
        <!--Establishing connection to the database -->
        <?php if( !$dbh = setup_UserDb_Connection() ) { die(); }?>

        <div class="pageContents">
            <?php
            // Setting the heading for the page:
            $heading = "Create Account";
            include "navbar.php"
            ?>

        <div class="setup_createAccount_header">
            <h1>Join Our Website</h1>
            <h4>The best way to become connected, with a community</h4>
        </div>

        <!-- Testing if the connection to the database is sucessful-->
        <?php if($debug): ?>
        <div class="success_Dd">
            <ol>
                <li>
                	Status of the database:<br>
                	<?php
                		$number_of_users = $dbh->query( "SELECT count(*) FROM users" );
                        echo "Number of users in database is = " . $number_of_users->fetchColumn()   . "<br>";
                	?>
                </li>
            </ol>
        </div>
        <?php endif; ?>

        <!-- this is the application for the user to fill out -->
        <div class="create_account_form">
            <form method="post" action="#" autocomplete="off">
                <div class="frmt_area">
                    First Name: <input type="text" name="first_name"><br>
                    Middle Name: <input type="text" name="middle_name" title="This is optional."><br>
                    Last Name: <input type="text" name="last_name"><br>
                    Phone Number: <input type="tel" name="phone_number"><br>
                    <hr class="form_divs">
                    Email: <input type="email" name="email">
                    Username: <input type="text" name="inputed_user_name" title="This will be the username you use to login to our site."><br>
                    Password: <input type="password" name="initial_password"><br>
                    Confirm Password: <input type="password" name="confirm_password"><br>
                    <hr class="form_divs">
                </div>
                <div class="frmt_prior_pets">
                    Prior Pets? Dogs:<input type="checkbox" name="dog_YN"> || Cats: <input type="checkbox" name="cat_YN"> || Turtles: <input type="checkbox" name="turtle_YN"><br>
                </div>
                Would you want to foster a Pet? <input type="checkbox" name="foster_pet"><br>
                Do you have a pet that needs a home? <input type="checkbox" name="pet_need_home"><br>
                <div class="frmt_response">
                    If 'yes' to the quetion above, please explain:<br>
                    <textarea placeholder="Explain." maxlength="140" name="pet_needHome_yes"></textarea>
                </div>
                Do you have any other pet that needs a home? <input type="checkbox" name="pet_need_home2"><br>
                <input type="submit" value="Submit" name="submit_cred">
            </form>
            <a href="login.php">Go Back</a>
        </div>

        <!--Now, ALL the PHP to go along with that form. Need to setup a SQLite database now and enter this informatin into a table -->
        <?php
            // function to test if the connectin to the database was successul:
            function setup_UserDb_Connection(){
                global $debug;
                try{
                    // setting up the connection:
                    $dbh = new PDO("sqlite:assets/project_2.db"); // passing the sqlite3 the database file.
                    // echo '<pre class="bg-success">'; // <pre> defines pre-formatted text.
	                // echo '</pre>';
                    // echo 'Connection successful.';
                    return $dbh;
                }catch(PDOException $e){
                    echo '<pre class="bg-danger">';
		            echo 'Connection failed (Help!): ' . $e->getMessage ();
                    echo '</pre>';
		            return FALSE;
                }
            }

            //ALL functions that operate on the given data above -- encapsulation
        	if( isset($_POST['submit_cred']) ){
        		// grab_all_input();
        		// SANITIZE ALL INPUT!
        		$first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
        		// echo "Entered first name: " . $first_name . "<br>";
        		$middle_name = filter_var($_POST['middle_name'], FILTER_SANITIZE_STRING);
        		// echo "Entered middle name: " . $middle_name . "<br>";
        		$last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
        		// echo "Entered last name: " . $last_name . "<br>";
        		$phone_number = filter_var($_POST['phone_number'], FILTER_SANITIZE_NUMBER_INT);
        		// echo "Entered phone number: " . $phone_number . "<br>";
        		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        		// echo "Entered email: " . $email . "<br>";
        		$username = filter_var($_POST['inputed_user_name'], FILTER_SANITIZE_STRING);
        		// echo "Entered username: " . $username . "<br>";
        		$initial_password = filter_var( $_POST['initial_password'], FILTER_SANITIZE_STRING );
                // echo "init pass = " . $initial_password . "<br>";
        		$confirm_password = filter_var( $_POST['confirm_password'], FILTER_SANITIZE_STRING );
                // echo "confirm pass = " . $confirm_password . "<br>";
                // converting the 'on' values for the checkbox
        		$prior_petsD = isset($_POST['dog_YN']) ? filter_var(convert_CB_value($_POST['dog_YN']), FILTER_SANITIZE_STRING) : 'no';
        		// echo "$prior_petsD <br>";
        		$prior_petsC = isset($_POST['cat_YN']) ? filter_var(convert_CB_value($_POST['cat_YN']), FILTER_SANITIZE_STRING) : 'no';
        		// echo "$prior_petsC <br>";
        		$prior_petsT = isset($_POST['turtle_YN']) ? filter_var(convert_CB_value($_POST['turtle_YN']), FILTER_SANITIZE_STRING) : 'no';
        		// echo "$prior_petsT <br>";
        		$foster_pet = isset($_POST['foster_pet']) ? filter_var(convert_CB_value($_POST['foster_pet']), FILTER_SANITIZE_STRING) : 'no';
        		// echo "$foster_pet <br>";
        		$pet_need_home = isset($_POST['pet_need_home']) ? filter_var(convert_CB_value($_POST['pet_need_home']), FILTER_SANITIZE_STRING) : 'no';
        		// echo "$pet_need_home <br>";
        		$other_pet_need_home = isset($_POST['pet_need_home2']) ? filter_var(convert_CB_value($_POST['pet_need_home2']), FILTER_SANITIZE_STRING) : 'no';
        		// echo "$other_pet_need_home <br>";
        		$response = filter_var($_POST['pet_needHome_yes'], FILTER_SANITIZE_STRING);
        		// echo "Response entered: <br>" . $response;

                // checking if the passwords are the same:
                if( !password_check($initial_password, $confirm_password) ){
                    $message = "Passwords do not match! Please enter them in again.";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }else{
                    // hashing the password after it has been checked for correctness:
                    $confirm_password = password_hash($confirm_password, PASSWORD_BCRYPT);
                    // INSERT the user into the database 'users':
        		      addUser($first_name, $middle_name, $last_name, $phone_number, $email, $username, $confirm_password, $prior_petsD, $prior_petsC,
                            $prior_petsT, $foster_pet, $pet_need_home, $response, $other_pet_need_home);
                        // redirect user to the login page:
                    echo "<script type='text/javascript'>setTimeout(\"location.href = 'login.php';\");</script>";
                }
        	}

        	function convert_CB_value($current_CB){
        		return ($current_CB == 'on') ? "yes" : "no";
        	}

            // function to check if the entered passwords are the same:
            function password_check($initPass, $confirmPass){
                return ( $initPass != $confirmPass ) ? FALSE : TRUE;
            }

        	function addUser($fn, $mn, $ln, $pn, $emale, $usrname, $password, $ppD, $ppC, $ppT, $fp, $pnh, $pnhResponse, $opnh){
        		global $dbh;
                global $debug;
                // setting the error thrown by this not to be false, but an actual exception:
        		try{
        			$sql_users = "INSERT INTO users (person_id, first_name, middle_name, last_name, phone_number,
                                                    email, user_name, password, prior_petsD, prior_petsC, prior_petsT,
                                                    foster_pet, pet_needing_home, pnh_response, other_pet_needing_home)
                                            VALUES (:person_id, '$fn', '$mn', '$ln', '$pn', '$emale', '$usrname', '$password', '$ppD', '$ppC',
                                                    '$ppT', '$fp', '$pnh', '$pnhResponse', '$opnh')";
                    if($debug) echo "$sql_users";
                    /*if($debug){
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        // checking if the query was successful!
        			    $stmt =  $dbh->prepare( $sql_users ); // retuns a PDOStatement object in which i call the exectue member function;
        			    echo "Did it succeed? = " . $stmt->execute(); // Returns TRUE on success or FALSE on failure.
                }*/
                    $dbh->query($sql_users);
                    $message = "Success! You are now part of the site!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
        		}catch(PDOException $e){
        			echo $e->getMessage();
        		}
        	}

        ?>

        </div>
        <?php include 'footer.php'; ?>
    </body>
  </html>
