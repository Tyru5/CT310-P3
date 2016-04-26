// Tyrus Malmstrom :: ajax to process data from petListURL 4/26/2016
// function to handle all form data:

var url = "http://www.cs.colostate.edu/~tmalmst/CT310-P3/petList.php";

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
          }
      }
      request.send( null );
}

function init(){
  processAnimals();
}

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
