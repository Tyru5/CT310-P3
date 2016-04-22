<!DOCTYPE html>
<html>
  <!-- Include the header.php file -->
  <head>
    <?php
      // Setting the title for this page:
      $title = "Adopt";
      $session_name = "PetRescue_Malmstrom_Bertolacci";
      include 'header.php';
      include "animal_tools.php";
	  include "lib/database.php";

      if( isset($_POST['COMMENT_SUBMIT']) ){
        $_GET['id']=$_POST['origin_get_id'];
      }

	  $db = new database();
	  $query = "SELECT * FROM animals WHERE id=".$_GET['id'].";";
	  $result = $db->query($query);

      if( ! isset($_GET['id']) ){
        header( 'Location: animal_listings.php' );
      }

	  /*
      $animal_tree = new AnimalTree( $ANIMALS_FILE );
      $animal = $animal_tree->getAnimalFromID( $_GET['id'] );

      if( $animal == NULL ){
        header( 'Location: animal_listings.php' );
      }
	  */

      if( isset($_POST['COMMENT_SUBMIT']) ){
		foreach ($result as $row)
		{

		// addComment sanitizes text input
		$filtered_comment = filter_var($_POST['comment_content'], FILTER_SANITIZE_STRING);
		$date = date('l jS \of F Y h:i:s A');
		$complete_comment = $row['pet_comments']."User ".$_SESSION['USERNAME']." posted on ".$date.": <br>".$filtered_comment."<br><br>";
        $sql_pet = "UPDATE animals SET pet_comments = '$complete_comment' WHERE id =".$_GET['id'];
		$db->query($sql_pet);
        //header( 'Location: animal_view.php?id='.$_GET['id'] ); // redirects the user to the page with the specifed ID towards that animal

		}
      }

    ?>
  </head>
  <body>
    <div class="pageContents"> <!-- Will hold all the page contents -->
      <?php
      // setting the Heading variable for the page:
      $heading = "Animals";
      include "navbar.php";

      ?>
      <?php
	  $query = "SELECT * FROM animals WHERE id=".$_GET['id'].";";
		$result = $db->query($query);


		foreach($result as $row)
		{?>

			<p>
			<img class="animalPhoto" src="<?php echo $row['pet_image_path'];?>" width="300px" height="300px" /><br>
      <ul class="animalEntry">
			    <li>Name: <?php echo $row['pet_name'];?></li>
			    <li>Species: <?php echo $row['pet_species'];?></li>
			    <li>Breed: <?php echo $row['pet_breed'];?></li>
			    <li>Age: <?php echo $row['pet_age'];?> yrs</li>
			    <li>Weight: <?php echo $row['pet_weight'];?> lbs</li>
      </ul>
			<br>
			<div class="about_us_header"><h2 class="abtUsText">Comments:</h2></div>
			<br><?php echo $row['pet_comments'];?><br>
			</p>


		<?php }
		/*
        echo $animal;
        $comments = $animal->getComments();

        echo "<div id=\"AnimalComments\">";
        echo "<h5 id=\"commentHeader\">Comment Section:</h5> \n";
        if( count($comments) < 1 ){ // $comments is an array, checking if there is at least one comment within the array
          echo "<p>No Comments!</p>";
        } else {
          foreach( $comments as $comment ){
            echo $comment;
          }
        }
        echo "</div>"
		*/
      ?>

      <?php
        $valid_login = isset($_SESSION['USERNAME']);
        if( $valid_login ):
      ?>

        <form method="post" action="animal_view.php">
          <textarea name="comment_content"></textarea>
          <input type="hidden" name="COMMENT_SUBMIT">
          <input type="hidden" name="origin_get_id" value=<?php echo "\"".$_GET['id']."\"" ?> >
          <input type="submit" value="Post">
        </form>
		<p>You are logged in as <?php echo $_SESSION['USERNAME'] ?></p>
      <?php else: ?>
        <p> You are not logged in. Only logged users can post comments. </p>
		<?php endif;
      ?>

    </div>

	<p id="go_back"><a href="animal_listings.php">Go back</a></p>
    <?php include 'footer.php'; ?>
  </body>
</html>
