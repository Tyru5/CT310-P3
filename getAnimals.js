// Tyrus Malmstrom :: ajax to process data from petListURL 4/26/2016
// function to handle all form data: Going to use JQuery.


function listAnimals(){

}

// function to create img DOM object:
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

function init(){
  listAnimals();
}
