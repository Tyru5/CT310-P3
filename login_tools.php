<?php
  require_once( "assets/bcrypt/passwordLib.php" );

  // $HASHES_FILE = $_SERVER["DOCUMENT_ROOT"]."/users.xml";
  $HASHES_FILE = "assets/users.xml";

  class PasswordsTable {
    private $table;

    public function __construct( $filename ){
      $file = fopen( $filename, 'r' );
      if( flock($file, LOCK_EX) ){
        $text = fread( $file, filesize($filename) );
        flock( $file, LOCK_UN );
        fclose( $file );
        $this->table = new SimpleXMLElement( $text );
      } else {
        echo "Could not get lock on " . $filename;
        error_log( "Could not get lock on " . $filename );
      }
    }

    private function find_user( $username ){

      foreach( $this->table->children() as $user ){
        if( $user->user_name == $username ){
          return $user;
        }
      }

      return null;
    }

    public function check_user( $username, $password ){
      $user = $this->find_user( $username );
      if( $user == null ){
        return false;
      }
      // MUST USE STRVAL!!! node is not a string.
      $val = password_verify( $password, strval($user->password_hash) );
      return $val;
    }
  }

?>
