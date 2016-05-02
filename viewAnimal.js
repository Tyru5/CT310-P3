// Tyrus :: function to get the variables within the URL of the page:

// Function to get the image from the AJAX call:
function displayImage(){
var test = getQueryVariable("imageURL");
var finalTest = test + "=" +  getQueryVariable("id");
console.log( finalTest ); 
jQuery.ajax({
    type: "GET",
    url: finalTest,
    dataType: "html",
      success: function (response) {
        console.log( response );
        var src = "data:image/jpg;base64,"+response;
        jQuery("#picyo").html("<h2 id = \"image_header\"> Image: <br>\<img class = \"animalPhoto\" src\= "+src+" /></h2>");
        // alert("Details saved successfully!!!");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log("couldn't retrive the image");
      }
    });
}

// function to get the description of the animal from the AJAX call:
function displayDesc() {
var test = getQueryVariable("descURL");
var finalTest = test + "=" +  getQueryVariable("id");
console.log( finalTest ); 
    jQuery.ajax({
          type: "GET",
          url: finalTest,
          dataType: "html",
          success: function (response) {
            console.log( response );
            jQuery("#desc").html(response);
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
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}

// testing the getQueryVariable function:
// console.log( getQueryVariable("imageURL") );
// console.log( getQueryVariable("descURL") );

// calling the functions:
displayImage();
displayDesc();
