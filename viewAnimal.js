// Tyrus :: function to get the variables within the URL of the page:

// Function to get the image from the AJAX call:
function displayImage(){
  if( ianGetQueryVariable().includes("~ibertola") ){
    var hisId = getQueryVariable("id");
    console.log( hisId );
    jQuery.ajax({
        type: "GET",
        url: "http://www.cs.colostate.edu/~ibertola/ct310/P3-dev/services/image_service.php?SERVICE=GET_IMAGE&ID=" + hisId,
        dataType: "html",
          success: function (response) {
            // alert( response );
            var src = "data:image/jpg;base64,"+response;
            var finalSrc = src.replace(/[\n\r]+/g,"");
            // console.log( finalSrc );
            jQuery("#picyo").html("<h2 id = \"image_header\"> Image: <br>\<img class = \"animalPhoto\" src\= "+finalSrc+" /></h2>");
            // alert("Details saved successfully!!!");
          },
          error: function (xhr, ajaxOptions, thrownError) {
            console.log("couldn't retrive the image");
          }
        });
  }
  else{
    var test = getQueryVariable("imageURL");
    // console.log(test);
    var finalTest = test + "=" +  getQueryVariable("id");
    var finalFinalTest = finalTest.replace("https","http"); // get rid of the https...
    //console.log( finalTest );
    jQuery.ajax({
      type: "GET",
      url: finalFinalTest,
      dataType: "html",
      success: function (response) {
        // alert( response );
        var src = "data:image/jpg;base64,"+response;
        var finalSrc = src.replace(/[\n\r]+/g,"");
        // console.log( finalSrc );
        jQuery("#picyo").html("<h2 id = \"image_header\"> Image: <br>\<img class = \"animalPhoto\" src\= "+finalSrc+" /></h2>");
        // alert("Details saved successfully!!!");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log("couldn't retrive the image");
      }
    });
  }

}


// function to display the petName:
function displayPetName(){
  var title = "Name: ";
  // console.log( getQueryVariable("petName") );
  var name = getQueryVariable("petName");
  jQuery("#petName").html( title + name );
}

// function to display the petKind:
function displayPetKind(){
  var title = "Pet Kind: ";
  console.log( getQueryVariable("petKind") );
  var kind = getQueryVariable("petKind");
  jQuery("#petKind").html( title + kind );
}

// function to display the petBreed:
function displayPetBreed(){
  var title = "Pet Breed: ";
  console.log( getQueryVariable("breed") );
  var breed = getQueryVariable("breed");
  jQuery("#breed").html( title + breed );
}

//function to display the datePosted:
function displayDatePosted(){
  var title = "Date Posted: ";
  console.log( getQueryVariable("datePosted") );
  var datePosted = getQueryVariable("datePosted");
  jQuery("#datePosted").html( title + datePosted );
}

// function to get the description of the animal from the AJAX call:
function displayDesc() {
var title = "<h3>Description:</h3> \n";
var test = getQueryVariable("descURL");
var finalTest = test + "=" +  getQueryVariable("id");
var finalFinalTest = finalTest.replace("https","http"); // get rid of the https...
// console.log( finalTest );
    jQuery.ajax({
          type: "GET",
          url: finalFinalTest,
          dataType: "json",
          success: function (response) {
            // console.log( response );
            jQuery("#desc").html( title +  response.description);
            // alert("Details saved successfully!!!");
          },
          error: function (xhr, ajaxOptions, thrownError) {
            console.log( xhr.status );
          }
        });
}


// function to get the URL variables:
function getQueryVariable(variable){
       var query = window.location.search.substring(1);
       // console.log(query);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}

function ianGetQueryVariable(){
  var query = window.location.search.substring(1);
  return query;
}

// calling the functions:
displayImage();
displayDesc();

function displayDets(){
  displayPetName();
  displayPetBreed();
  displayPetKind();
  displayDatePosted();
}
