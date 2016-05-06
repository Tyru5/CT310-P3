<?php
header('Content-Type: text/json');

$animalArray = array();
$i = 0;

$animalArray[$i++] = array(

  "petName" =>  "Lilly",
  "petKind" =>  "Mammal",
  "breed"   =>  "Pitbull",
  "datePosted" => "04/29/2016",
  "imageURL" =>  "http://www.cs.colostate.edu/~tmalmst/CT310-P3/getImage.php?petId=1",
  "petId"   =>  "1",
  "descURL" =>  "http://www.cs.colostate.edu/~tmalmst/CT310-P3/getDesc.php?petId=1",

);

$animalArray[$i++] = array(

  "petName" =>  "Charles",
  "petKind" =>  "Mammal",
  "breed"   =>  "cutest kittie",
  "datePosted" => "04/25/2016",
  "imageURL" =>  "http://www.cs.colostate.edu/~tmalmst/CT310-P3/getImage.php?petId=2",
  "petId"   =>  "2",
  "descURL" =>  "http://www.cs.colostate.edu/~tmalmst/CT310-P3/getDesc.php?petId=2",

);

$animalArray[$i++] = array(

  "petName" =>  "Snuzzles",
  "petKind" =>  "Mammal",
  "breed"   =>  "cuter kittie",
  "datePosted" => "04/20/2016",
  "imageURL" =>  "http://www.cs.colostate.edu/~tmalmst/CT310-P3/getImage.php?petId=3",
  "petId"   =>  "3",
  "descURL" =>  "http://www.cs.colostate.edu/~tmalmst/CT310-P3/getDesc.php?petId=3",


);

$animalArray[$i++] = array(

  "petName" =>  "Lucas",
  "petKind" =>  "na",
  "breed"   =>  "na",
  "datePosted" => "04/30/2038", // end of the world!
  "imageURL" =>  "http://www.cs.colostate.edu/~tmalmst/CT310-P3/getImage.php?petId=4",
  "petId"   =>  "4",
  "descURL" =>  "http://www.cs.colostate.edu/~tmalmst/CT310-P3/getDesc.php?petId=4",

);

// print_r($animalArray);
echo json_encode($animalArray);


?>
