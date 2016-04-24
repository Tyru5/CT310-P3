<?php
header('Content-Type: text/json');

$siteStatus = array("status" => "down"); // this is because we are still working on the site.
echo json_encode($siteStatus);

?>
