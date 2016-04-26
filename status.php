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

    <!--javaScript to handle the AJAX call to the masterAPI hosted php page -->
    <script type="text/javascript" src="masterAPI.js"></script>
    <script type="text/javascript">
	   window.onload = masterAPI;
    </script>

  </head>
  <body>

      <div class="pageContents">

    <?php
      // setting the page Heading:
      $heading = "Status";
      include 'navbar.php';
    ?>

    <div class="setup_createAccount_header">
        <h1>Status:</h1>
    </div>

    <!--Table for displaying the status's of all the other pages-->
    <table id="status_table">
        <tr>
            <th>Site Name</th>
            <th>Page Awake URL</th>
            <th>Page Pet Listing URL</th>
            <th>Status</th>
        </tr>
    </table>


</div>
  <?php include "footer.php" ?>
  </body>
</html>
