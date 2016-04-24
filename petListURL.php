<?php
header('Content-Type: text/json');
include 'lib/database.php';

$db = new database();
$animalQuery = $db->query("SELECT * FROM animals");
$res = $animalQuery->fetchAll();

echo json_encode($res);

?>
