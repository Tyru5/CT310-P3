<?php
  $ANIMALS_FILE = "assets/animal_data/animals.xml";

  class Comment {
    private $tree;
    private $id;

    function __construct( $subtree ){
      $this->tree = $subtree;
      $this->id = $this->tree['id'];
    }

    function __toString(){
      return  "<p>"
            . $this->getUser()
            . " wrote at "
            . date( "l d, M. g:i a", intval($this->getDate()) )
            . "</p><p class=\"comments\">"
            . "-".$this->getText()
            . "</p>";
      }

    function getID(){
      return $this->id;
    }

    function getUser(){
      return $this->tree->user;
    }

    function getText(){
      return $this->tree->text;
    }

    function getDate(){
      return $this->tree->date;
    }

  }

  function Comment_cmp($a, $b){
    return intval($a->getDate()) < intval($b->getDate());
  }

  class AnimalTree{
    private $tree;
    private $filename;

    public function __construct( $filename ){
      $this->filename = $filename;
      $file = fopen( $this->filename, "r" );
      if( flock($file, LOCK_EX) ){
        $xml_text = fread($file, filesize($this->filename) );
        $this->tree = new SimpleXMLElement($xml_text);
        flock($file, LOCK_UN);
        fclose( $file );
      } else {
        echo "Could not get lock on " . $filename;
        error_log( "Could not get lock on " . $filename );
      }

    }

    public function getAnimalFromID( $id ){
      $animal = NULL;
      foreach( $this->tree->children() as $sub_tree ){
        if( $sub_tree['id'] == $id ){
          $animal = new Animal( $this, $sub_tree );
          break;
        }
      }
      return $animal;
    }

    public function getIterable( ){
      $list_of_animals = array();

      foreach( $this->tree->children() as $sub_tree ){
        $list_of_animals [] = new Animal( $this, $sub_tree );
      }

      return $list_of_animals;
    }

    public function writeToFile(){

      // For pretty printing XML file
      $dom = new DOMDocument('1.0');
      $dom->preserveWhiteSpace = false;
      $dom->formatOutput = true;
      $dom->loadXML( $this->tree->asXML() );

      $text = $dom->saveXML();

      $file = fopen( $this->filename, "w" );
      if( flock($file, LOCK_EX) ){
        fwrite( $file, $text );
        fflush( $file );
        flock($file, LOCK_UN);
        fclose( $file );
      } else {
        echo "Could not get lock on " . $filename;
        error_log( "Could not get lock on " . $filename );
      }
    }
  }


  class Animal {
    private $animal_tree;
    private $tree;
    private $id;

    function __construct( $animal_tree, $subtree ){
      $this->animal_tree = $animal_tree;
      $this->tree = $subtree;
      $this->id = $this->tree['id'];
    }

    function __toString(){
      return    "<img class=animalImg src=\"assets/animal_data/images/"
              . $this->getImageSrc()
              ."\"/><p class=imgDisclaimer>"
              . $this->getImageRights()
              . " <a class=\"imgSource\" href=\""
              . $this->getImageOrigin()
              . "\">Source</a></p><ul class=animalEntry><li>Name: "
              . $this->getName()
              . "</li><li>Description: "
              . $this->getDescription()
              . "</li></ul>" ;
    }

    function getID(){
      return $this->id;
    }

    function getName(){
      return $this->tree->name;
    }

    function getDescription(){
      return $this->tree->description;
    }

    function getImage(){
      return $this->tree->image;
    }

    function getImageSrc(){
      return $this->getImage()->src;
    }

    function getImageRights(){
      return $this->getImage()->rights;
    }

    function getImageOrigin(){
      return $this->getImage()->origin;
    }

    function getComments(){
      $list_of_comments = array();

      foreach( $this->tree->comments->children() as $sub_tree ){
        $list_of_comments [] = new Comment( $sub_tree );
      }

      if( count($list_of_comments) > 1 ){
        usort( $list_of_comments, "Comment_cmp" );
      }

      return $list_of_comments;
    }

    function addComment( $user, $text ){
      $list_of_Comments = $this->getComments();

      $comment_node = $this->tree->comments->addChild("comment" );
      $comment_node->addAttribute("id", count($list_of_Comments)) ;
      $comment_node->addChild("user", $user );
      $comment_node->addChild("date", strval(time()));
      $comment_node->addChild("text", filter_var( filter_var( $text , FILTER_SANITIZE_STRING ), FILTER_SANITIZE_FULL_SPECIAL_CHARS )  );

      $this->animal_tree->writeToFile();
    }
  }
?>
