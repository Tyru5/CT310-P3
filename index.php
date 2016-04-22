<!DOCTYPE html>
<html>
  <head>
    <?php
      // Setting the title for this page:
      $title = "Welcome";
      $session_name = "PetRescue_Malmstrom_Bertolacci";
      include 'header.php';
      include 'animal_tools.php';
    ?>
  </head>
  <body>
    <div class="pageContents"> <!-- Will hold all the page contents -->
      <?php
      // setting the page Heading:
      $heading = "Welcome";
      include "navbar.php"
      ?>

      <div class="about_us_header"><h2 class="abtUsText" style="text-align: center;">Welcome!</h2></div>
      <p id="pageIntro">
          We are Bertolmalmi Inc. and our mission is simple. We want to rescue, rehabilitate, and bring relief
          to the animals that are abused and not cared for.From the collective effort of our employees, our volunteers,
          and even you, we <strong>will</strong> bring an <strong>end</strong> to animal cruelty.
      </p>

      <p id="imageCaption">Look at some of our rescued animals!</p>
      <div id="main_animal_wrapper">
        <?php
        $animal_tree = new AnimalTree( $ANIMALS_FILE );
        $animal_list = $animal_tree->getIterable();
        if( count($animal_list) >= 5 ){
          $animal_list = array_slice( $animal_list, 0, 5 );
        }
        echo array_reduce(  $animal_tree->getIterable(),
                            function ($carry, $item){
                              return  $carry
                                    . "<div class=\"frmt\">
                                    . "
                                    ."<img src=\"assets/animal_data/images/"
                                    . $item->getImageSrc()
                                    . "\" class=\"welcome_imgFrmt\"><figcaption>"
                                    . $item->getName()
                                    . "</figcaption></a></div>";
                            },
                            "");
        ?>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>
