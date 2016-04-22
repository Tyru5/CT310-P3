<!DOCTYPE html>
<html>
  <head>
    <?php
      $debug = FALSE;
      // Setting the title for this page:
      $title = "Add pet for adoption";
      $session_name = "PetRescue_Malmstrom_Bertolacci"; // need to change this for the new project 2!
      include 'header.php';
      // user has not logged in yet:
      if( isset($_SESSION['USERNAME']) ){
        // cool, user has logged in!
      }else{
        // ALL code to check if the user is logged in;
          $message = "You can not access this if you are not logged in! Please Login!";
          echo "<script type='text/javascript'>alert('$message');</script>";
          echo "<script type='text/javascript'>setTimeout(\"location.href = 'login.php';\");</script>";
          // reseting the SESSioN variable
          unset( $_SESSION['USERNAME'] );
          session_unset();
          session_destroy();
        }
	    $max_file_size = 1000000; // small
      require_once( "assets/bcrypt/passwordLib.php" ); // for using the password_verify and password_hash functions.
    ?>
  </head>
    <body>
        <!--Establishing connection to the database -->
        <?php if( !$dbh = setup_UserDb_Connection() ) { die(); }?>

        <div class="pageContents">
            <?php
            // Setting the heading for the page:
            $heading = "Add pet for adoption";
            include "navbar.php"
            ?>

        <div class="setup_createAccount_header">
            <h1>Add pet for adoption</h1>
            <h4>Do you have a pet that needs a new home? Show it here!</h4>
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
            <form method="post" action="#" enctype="multipart/form-data" autocomplete="off">
                <div class="frmt_area">
					Upload Image:<input type="file" name="image_filename" id="image_filename"><br>
                    Name: <input type="text" name="pet_name"><br>
                    Species: <input type="text" name="pet_species"><br>
                    Breed: <input type="text" name="pet_breed"><br>
                    Age: <input type="number" name="pet_age"><br>
					Weight: <input type="number" name="pet_weight"><br>
          <div class="frmt_response">
					Description:<br>
                    <textarea placeholder="Pet's description." maxlength="140" name="pet_description"></textarea>
          </div>
                </div>
                <input type="submit" value="Upload" name="submit_pet">
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
        	if( isset($_POST['submit_pet']) )
			{
        		$pet_name = filter_var($_POST['pet_name'], FILTER_SANITIZE_STRING);
        		$pet_species = filter_var($_POST['pet_species'], FILTER_SANITIZE_STRING);
        		$pet_breed = filter_var($_POST['pet_breed'], FILTER_SANITIZE_STRING);
        		$pet_age = filter_var($_POST['pet_age'], FILTER_SANITIZE_NUMBER_INT);
				    $pet_weight = filter_var($_POST['pet_weight'], FILTER_SANITIZE_NUMBER_INT);
        		$pet_description = filter_var($_POST['pet_description'], FILTER_SANITIZE_STRING);



				$image_tmpname = $_FILES['image_filename']['name'];
        // had to change the path where to put the images:
				$imgdir = "assets/uploads";
				$imgname = $imgdir.$image_tmpname;
				if(move_uploaded_file($_FILES['image_filename']['tmp_name'], $imgname))
				{
					list($width,$height,$type,$attr)= getimagesize($imgname);
					switch($type)
					{
					 case 1:
					  $ext = ".gif"; break;
					 case 2:
					  $ext = ".jpg"; break;
					 case 3:
					  $ext = ".png"; break;
					 default:
					   echo "Not acceptable format of image";
					}
					addPet($imgname, $pet_name,$pet_species,$pet_breed,$pet_age,$pet_weight,$pet_description);
					chmod($imgname, 0755);

				}

        	}

        	function convert_CB_value($current_CB){
        		return ($current_CB == 'on') ? "yes" : "no";
        	}

            // function to check if the entered passwords are the same:
            function password_check($initPass, $confirmPass){
                return ( $initPass != $confirmPass ) ? FALSE : TRUE;
            }

        	function addPet($imgname, $name, $species, $breed, $age, $weight, $description){
        		global $dbh;
                global $debug;
                // setting the error thrown by this not to be false, but an actual exception:
        		try{
        			$sql_pet = "INSERT INTO animals (id, pet_image_path, pet_name, pet_species, pet_breed, pet_age,
                                                    pet_weight, pet_description)
                                            VALUES (:id, '$imgname', '$name', '$species', '$breed', '$age', '$weight', '$description')";
                    if($debug) echo "$sql_pet";
                    /*if($debug){
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        // checking if the query was successful!
        			    $stmt =  $dbh->prepare( $sql_users ); // retuns a PDOStatement object in which i call the exectue member function;
        			    echo "Did it succeed? = " . $stmt->execute(); // Returns TRUE on success or FALSE on failure.
                }*/
                    $dbh->query($sql_pet);
                    $message = "Success! This pet is now part of the site!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    echo "<script type='text/javascript'>setTimeout(\"location.href = 'animal_listings.php';\");</script>";
        		}catch(PDOException $e){
        			echo $e->getMessage();
        		}

        	}

        ?>

        </div>


        <?php
		/* Support functions for handling image upload above. */
		function parseFileSuffix($iType) {
	if ($iType == 'image/jpeg') {
		return 'jpg';
	}
	if ($iType == 'image/gif') {
		return 'gif';
	}
	if ($iType == 'image/png') {
		return 'png';
	}
	if ($iType == 'image/tif') {
		return 'tif';
	}
	return '';
}
		include 'footer.php'; ?>
    </body>
  </html>
