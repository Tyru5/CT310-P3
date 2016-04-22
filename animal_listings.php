<!DOCTYPE html>
<html>
  <!-- Include the header.php file -->
  <head>
    <?php
      // Setting the title for this page:
      $title = "Adopt";
      $session_name = "PetRescue_Malmstrom_Bertolacci";
      include 'header.php';
	  include 'lib/database.php';
      include "animal_tools.php";
    ?>
    <!--All code for the AJAX call to the database-->
    <script type="text/javascript">
    // function to handle all form data:
    function showAnimal(animal){
        // console.log(animal);
        if( animal.length == 0 ){
            document.getElementById('livesearch').innerHTML = "";
            document.getElementById('livesearch').style.border = "0px";
            return;
        }
        if (window.XMLHttpRequest){
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest(); // creating the ajax object itself
        } else {  // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        // actual 'guts' of call:
        xmlhttp.onreadystatechange = function() {
            // cheking the state of the ajax object:
            if( xmlhttp.readyState == 4 && xmlhttp.status == 200){ // More info here: https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
                document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
                document.getElementById("livesearch").style.border="1px solid #4A7023";
            }
        }
        xmlhttp.open("GET","animal_search.php?animal="+animal,true); // boolean value defaults to true if you want to send async.
        xmlhttp.send(null);
    }
    </script>
  </head>
  <body>
    <div class="pageContents"> <!-- Will hold all the page contents -->
      <?php
      // Setting the heading for the page:
      $heading = "Animals";
      include "navbar.php"
      ?>
      <div class="about_us_header"><h2 class="abtUsText">Our Animals:</h2></div>
      <!--Assignment #2 AJAX live search for any animal in our database::tyru5 -->
      <form>
          <input id="search_animal" type="text" size="30" placeholder="Search Animal" onkeyup="showAnimal(this.value)" autocomplete="off">
          <div id="livesearch"></div>
      </form>
      <?php
		$db = new database();
	  $result = $db->query('SELECT * FROM animals');

		foreach($result as $row)
		{?>
			<p>
			<img class="animalImg" src="<?php echo $row['pet_image_path'];?>" width="300px" height="300px" /><br>
      <ul class="animalEntry">
		      <li>Name: <?php echo $row['pet_name'];?></li>
			    <li>Species: <?php echo $row['pet_species'];?></li>
			    <li>Breed: <?php echo $row['pet_breed'];?></li>
			    <li>Age: <?php echo $row['pet_age'];?> yrs</li>
			    <li>Weight: <?php echo $row['pet_weight'];?> lbs</li>
			    <li>Description: <?php echo $row['pet_description'];?></li>
			    <li><a href=<?php echo 'animal_view.php?id='. $row['id']; ?> >Click here to view</a></li>
        </ul>
			</p>
			<hr>
		<?php
		}
	  /*
        $animal_tree = new AnimalTree( $ANIMALS_FILE );

        echo array_reduce( $animal_tree->getIterable(),
                            function ($carry, $item){
                              return $carry . ( ($carry == NULL) ? "" : "<hr>" ) . $item->__toString() .
                              "<a class=\"animalView\" href=\"animal_view.php?id=".$item->getID()."\">Click here to view " . $item->getName() . "!</a> \n" ;
                            }
                          );
		*/



        /*foreach( $animal_tree->getIterable() as $pet ){
          echo $pet;
        }*/

      ?>

    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>
