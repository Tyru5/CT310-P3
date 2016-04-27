// Tyrus Malmstrom :: ajax to process data from petListURL 4/26/2016
// function to handle all form data:

var url = "http://www.cs.colostate.edu/~tmalmst/CT310-P3/petList.php";

function ajax_request(){
    // depending on the web browser you are using, return the correct ajax object:
    // doing this so that my code can work across all (most) platforms:

    // current, up to date way of creating an ajax object.
        try{
            var request = new XMLHttpRequest();
        }catch(exception){
            // using IE6+: <-- why microsoft, why?
            try{
                request = new ActiveXObject("Msxml2.XMLHTTP");
            }catch(exception2){
                try{
                // using IE5 <-- again, why?
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(exception3){
                request = false;
            }
        }
    }
    return request;
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


function pprint( status ){
  // going to use javascript to create DOM elements:
  create_list(status);
}

function processAnimals(){
    var status; // wow! this is weird, i don't know why I have to do this.
    // function that will display the image using ajax:
    // always since, I'm using the $_GET method to pass data, I will generate a random 'key' that will not allow the browser to cache the data.
    var nocache = "&nocache=" + Math.random() * 1000000;
    request = new ajax_request();

      request.open("GET",url, true); // boolean value defaults to true if you want to send async.
      request.onreadystatechange = function() {
          // cheking the state of the ajax object:
          if( request.readyState == 4 && request.status == 200){ // More info here: https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
            status = JSON.parse( request.responseText );
            // console.log(status);
            pprint( status );
          }
      }
      request.send( null );
}

function init(){
  processAnimals();
}
