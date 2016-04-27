<?php
// CODE given to us by Professor and GTA, thank you. 4/25/2016
header("Access-Control-Allow-Origin: *");

//code that connects to the database to get the correct Id for that image:
include 'lib/database.php';
$id = $_GET['petId'];
$dbh = new database();

$animalQuery = $dbh->query("SELECT pet_description FROM animals WHERE id= '$id'");
$res = $animalQuery->fetchColumn();
echo $res;
exit;
?>
