<?php
// CODE given to us by Professor and GTA, thank you. 4/25/2016
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/json');

//code that connects to the database to get the correct Id for that image:
include 'lib/database.php';
$id = $_GET['petId'];
$dbh = new database();

$animalQuery = $dbh->query("SELECT pet_description FROM animals WHERE id= '$id'");
$res = $animalQuery->fetchColumn();
// var_dump($res);
$desc['description'] = $res;
echo json_encode($desc);
exit;
?>
