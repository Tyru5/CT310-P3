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
      // adding the call to the master list api:
      include 'masterAPI.php';
      require_once 'lib/database.php'; // require all database code.
    ?>

  </head>
  <body>

      <div class="pageContents">

    <?php
      // setting the page Heading:
      $heading = "Status";
      include 'navbar.php';
    ?>

    <div class="setup_createAccount_header">
        <h1>.:Check out all of the other sites in our Federation:.</h1>
    </div>

    <!--Table for displaying the status's of all the other pages-->
    <table id="status_table">
        <tr>
            <th>Site Name</th>
            <th>Awake URL</th>
            <th>Pet Listing URL</th>
            <th>Status</th>
        </tr>
    </table>


</div>
  <?php include "footer.php" ?>
  </body>
</html>
