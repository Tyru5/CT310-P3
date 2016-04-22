<?php
include 'lib/database.php';
//get the animal parameter from URL
$id = filter_var($_GET["animal"], FILTER_SANITIZE_STRING); // sanitize inputs main
//setting up the database connection:
$db = new database();
?>

<?php if ( strlen($id)>0 ) {
  $hint = "exits";
  $animal = $db->search_animal($id);
  // var_dump($animal);
  // if the value is NULL, set hint to specified value:
  if( $animal == NULL ){
    $hint = "";
  }
  if($animal){?>

    <?php foreach($animal as $row): ?>

      <a id = "search_animal" href="animal_view.php?id= <?php echo $row['id']; ?>"
                            target = "_blank" style = "text-decoration: underline;"> <?php echo $row['pet_name']; ?></a><br>

      <?php endforeach; ?>

  <?php }else{
      $hint = "";
  }
}?>

<?php
// Set output to "no suggestion" if no hint was found
// or to the correct values
if ( $hint == "" ) {
  echo "No such animal exits here!";
}
?>
