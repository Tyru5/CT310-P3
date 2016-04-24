<!DOCTYPE html>
<html>
  <head>
    <?php
      $debug = FALSE;
      // Setting the title for this page:
      $title = "Status";
      $session_name = "PetRescue_Malmstrom_Bertolacci";
      include 'header.php';
      include 'login_tools.php';
      require_once 'lib/database.php'; // require all database code.
    ?>
  </head>
  <body>
      <!--Establishing connection to the database -->
      <?php if( !$dbh = setup_UserDb_Connection() ) { die(); }?>
      <div class="pageContents">

    <?php
      // setting the page Heading:
      $heading = "Status";
      include 'navbar.php';
    ?>

</div>
  <?php include "footer.php" ?>
  </body>
</html>
