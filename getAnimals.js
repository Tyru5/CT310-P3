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
        // console.log( response );
        getPetSite( response );
      },
      error: function (xhr, ajaxOptions, thrownError) {
        // console.log(xhr.responseText);
        console.log("First AJAX call failed.");
      }
    });
}


function getPetSite( petSite ){
  for(var i in petSite){
    requestPets(petSite[i].petsListURL);
  }
}

function requestPets( currentPetSite ){
  $.ajax({
      type: "GET",
      url: currentPetSite,
      dataType: "json",
      success: function (response) {
        thePetList = ( response );
        // console.log( response );
        create_list( response );
      },
      error: function (xhr, ajaxOptions, thrownError) {
        // console.log(xhr.responseText);
        console.log("Second AJAX call failed.");
      }
    });
}

// function to create the list for each animal:
function create_list( status ){
  var nameOfDog = "Name: ";
  var datePosted = "Date Posted: ";
  var str = '<ul class=animalEntry>';
  for(var i in status){
    if( status[i].awakeURL == "down" ){
      console.log("in the down awakeURL");
      return;
    }else{
    str +='<li>' + nameOfDog +status[i].petName + '</li>' +
          '<li>' + datePosted + status[i].datePosted + '</li>' +
          '<li><a href=' + status[i].imageURL + '>Click here to view Pet!</a></li><br>';
        }
  }
  str += '</ul>';
  $('.pageContents').append(str); //yes!
}

// Obtaining the list:
getList();
