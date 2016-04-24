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
    <table border="1" id="status_table">
        <tr>
            <td>Jill</td>
            <td>Smith</td>
            <td>50</td>
        </tr>
        <tr>
            <td>Eve</td>
            <td>Jackson</td>
            <td>94</td>
        </tr>
    </table>


</div>
  <?php include "footer.php" ?>
  </body>
</html>
