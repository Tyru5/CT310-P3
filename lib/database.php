<?php
// require some files here!

class database extends PDO{

    // constructor for the class --> will overload the PDO constructor
    public function __construct(){
        parent::__construct("sqlite:" . __DIR__ . "/../assets/project_2.db");
    }

    // member function to get the number of users:
    function getNumberOfUsers(){
        $users_num = $this->query( "SELECT count(*)  FROM users" );
        return $users_num->fetchColumn();
    }


    // member function to find the user given:
    function find_user_in_DB($username){
        $stmt = $this->query("SELECT count(*) FROM users WHERE user_name = '$username'");
        // ~~~~~~~~~~~~~~~~IMPORTANT~~~~~~~~~~~~~~~~~~~~~~
        /*For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
        Instead, use PDO::query() to issue a SELECT COUNT(*) statement with the same predicates as your intended SELECT statement,
        then use PDOStatement::fetchColumn() to retrieve the number of rows that will be returned.
        Your application can then perform the correct action.*/
        if($stmt->fetchColumn() > 0){
           // echo "exists! <br>";
           $res = $this->query("SELECT user_name FROM users WHERE user_name= '$username'");
           return $res->fetchColumn();
        } else {
           // echo "non existant <br>";
           return null; // negate top statement.
        }
    }

    // member function to validate user login:
    function check_user($username, $password){
        $user = $this->find_user_in_DB( $username );
        if( $user == null ){
          return false;
        }
        $actual_pass = $this->query( "SELECT password FROM users WHERE user_name = '$username' ");
        $res = $actual_pass->fetchColumn();
        // echo "actual password is = " . $actual_pass;
        $val = password_verify( $password,  $res );
        return $val;
      }

      // member function that finds and sends the correct user the email for reseting instrucitons:
      function send_email($email){
      	$sql_email = $this->query( "SELECT count(*) FROM users WHERE email = '$email' " );
      	// checking if that user is in the database:
      	if($sql_email->fetchColumn() > 0){
      		// echo "user exists!<br>";
      		$res = $this->query( "SELECT email FROM users WHERE email = '$email' " );
      		$current_email = $res->fetchColumn();
      		/*(Windows only) When PHP is talking to a SMTP server directly,
      		 if a full stop is found on the start of a line, it is removed.
      		 To counter-act this, replace these occurrences with a double dot.
      		 */
      		$current_email = str_replace("\n.", "\n..", $email);
      		// echo "The email is = " . $current_email;
      		$subject = "Resetting your Password";
      		// php file that generates the random 32 length key:
      		$key = str_shuffle("1337abcdegTYUIOML:.,//??QQWeerrn");
      		// saving key to a session variable for further client checking:
      		$_SESSION['current_key'] = $key;
      		$content = "Follow this link to reset your password: \n " . "https://".$_SERVER['HTTP_HOST']."/~tmalmst/P2_Dev/proj_2/passwordreset.php"."?key=$key"; // had to change the absolute path when I removed one of the unessecary folders.
      		// echo "<br>\n";
      		// echo $content;
      		error_reporting(E_ALL);
      		if( mail($email,$subject,$content) ){
      			echo "<p class=\"notificationG\">An email has been sent to: $email regarding insturctions on how to reset your password.</p>";
      		}
      		else{
      			echo "<p class=\"notificationS\">There was an error trying to send an email to you.</p>";
      		}
      	}else{
      		echo "<p class=\"notificationS\">Sorry, there is no user with the email \"$email\" in our records</p>";
      	}
      }

      // member function to update the password of the inputed email:
      function update_password($email, $newPassword){
      	$sql_update = $this->query( "UPDATE users SET password = '$newPassword' WHERE email = '$email' " );
      	$message = "Password changed successfully!";
      	echo "<script type='text/javascript'>alert('$message');</script>";
      }

      // function to lookup animal based on the ajax call:
      function search_animal($animal){
          $animal_stmt = $this->query("SELECT count(*) FROM animals WHERE pet_name LIKE '%$animal%'");
          if($animal_stmt->fetchColumn() > 0){
             // echo "exists! <br>";
             $res = $this->query("SELECT pet_name,id FROM animals WHERE pet_name LIKE '%$animal%'");
             return $res->fetchAll();
          } else {
             // echo "non existant <br>";
             return null; // negate top statement.
          }
      }

}

 ?>
