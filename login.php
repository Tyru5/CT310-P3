<!DOCTYPE html>
<html>
  <head>
    <?php
      $debug = FALSE;
      // Setting the title for this page:
      $title = "Login";
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
      $heading = "Login";
      include 'navbar.php';
    ?>

    <?php
      if( isset($_POST['LOGOUT']) ){
        unset($_SESSION['USERNAME']);
        session_unset();
        session_destroy();
      }

      $valid_login = isset($_SESSION['USERNAME']);

      if( isset($_POST['SUBMIT_CRED']) ){ // hit the button for submission!
        if( isset($_POST['username']) && isset($_POST['password']) ){
          $username = filter_var( $_POST['username'] , FILTER_SANITIZE_STRING ); // sanitizing the inputes main!
          $password = filter_var( $_POST['password'] , FILTER_SANITIZE_STRING );

          // ALL OLD CODE FROM PROJECT 1:
          // $table = new PasswordsTable( $HASHES_FILE );
          // $valid_login = $table->check_user($username, $password);

          // ALL NEW CODE FOR PROJECT 2:
          $db = new database(); // our database code that extends the PDO class.
          $valid_login = $db->check_user($username, $password);
          // var_dump($valid_login);

          if( $valid_login ){
            $_SESSION['USERNAME'] = $username;
            $_SESSION['start_time'] = time();
          } //if $valid_login
        } // isset()
      } // endif( isset($_POST['SUBMIT_CRED']) )
    ?>

    <?php if( !$valid_login && isset($_POST['SUBMIT_CRED']) ): ?>
    <p class="notificationS">Invalid Credintials</p>
    <?php endif; ?>

    <?php if( !$valid_login ): ?>
    <div class="login_message">
        <form method="post" action="login.php">
            Username: <input type="text" name="username">
            <br>
            Password: <input type="password" name="password">
            <br>
            <div id="fmp">
                <a href="fmp.php">Forgot Password?</a>
            </div>
            <input type="hidden" name="SUBMIT_CRED">
            <input type="submit" value="Enter">
        </form>
    </div>
    <?php else: ?>
        <div class="logout_message">
            <p>You are logged in as <?php echo $_SESSION['USERNAME'] . "!"; ?></p>
            <p>You have been logged in for <?php echo time() - $_SESSION['start_time'];?> seconds.</p>
                <form method="post" action="login.php">
                    <input type="hidden" name="LOGOUT" >
                    <input type="submit" value="Logout" >
                </form>
        </div>
    <?php endif; ?>

    <!-- Starting Assignment 2!  Creating the 'Create Account' section  if the user is allowed-->
    <?php
      $ip = $_SERVER['REMOTE_ADDR'];
      $ip = substr($ip, 0,9);
     ?>
     <?php if( $ip == '129.82.44' || $ip == '129.82.45' ) : ?>
    <div class="create_account">
        New to this site? <a id="create_account_link" href="create_account.php">Create an account</a>.
    </div>
    <?php endif; ?>

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

    ?>

</div>
  <?php include "footer.php" ?>
  </body>
</html>
