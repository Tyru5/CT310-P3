<?php
// CODE given to us by Professor and GTA, thank you. 4/25/2016
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/json');

$siteStatus = array("status" => "up"); // this is because we are still working on the site.
echo json_encode($siteStatus);

?>
