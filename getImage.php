<?php
// CODE given to us by Professor and GTA, thank you. 4/25/2016
header("Access-Control-Allow-Origin: *");

//code that connects to the database to get the correct Id for that image:
include 'lib/database.php';
$id = $GET['petId'];
$dbh = new database();

$animalQuery = $dbh->query("SELECT pet_image_path FROM animals WHERE id= '$id'");
$res = $animalQuery->fetchColumn();

$fp = fopen("$res", 'rb'); // this allows for the dynamic path to the image.
$str = file_get_contents($fp, FILE_USE_INCLUDE_PATH);
echo base64_encode($str);
exit;
?>
