// Tyrus Malmstrom :: ajax to process data from petListURL 4/26/2016
// function to handle all form data: Going to use JQuery.
// function to create img DOM object:

var masterURL = 'https://www.cs.colostate.edu/~ct310/yr2016sp/more_assignments/project03masterlist.php'; // page that has the master List

// get the masterList api of sites in the federation:
function getList(){
  // JQuery to handle the ajax call:
  var thePetList;
  $.ajax({
      type: "GET",
      url: masterURL,
      dataType: "json",
      success: function (response) {
        thePetList = ( response );
        console.log( response );
        // create_list( response );
      },
      error: function (xhr, ajaxOptions, thrownError) {
        // console.log(xhr.responseText);
        console.log("AJAX call failed.");
      }
    });

}

function img_create(src, alt, title, clazz, width, height) {
    var img = document.createElement('img');
    img.src= src;
    img.className = clazz;
    img.width = width;
    img.height = height;
    if (alt!=null) img.alt= alt;
    if (title!=null) img.title= title;
    img.onload = function(){
      img.src = src;
      $(".picyo").html(img);
    }
}

// function to create the list for each animal:
function create_list( status ){
  var nameOfDog = "Name: ";
  var datePosted = "Date Posted: ";
  var str = '<ul class=animalEntry>';
  for(var i in status){
    str +='<li>' + nameOfDog +status[i].petName + '</li>' +
          '<li>' + datePosted + status[i].datePosted + '</li>' +
          '<li><a href=' + status[i].imageURL + '>Click here to view Pet!</a></li><br>';
  }
  str += '</ul>';
  $('.pageContents').append(str); //yes!
}

// Obtaining the list:
getList();
