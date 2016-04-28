// Tyrus Malmstrom
//All code to handle the ajax call to the masterAPI page:

var vurl = 'https://www.cs.colostate.edu/~ct310/yr2016sp/more_assignments/project03masterlist.php'; // page that has the master List
var http = false;

// creating our site into a JSON object: for testing
var our_siteJSONobj = { "siteName":"tyru5Dan::Pet_Rescue", "awakeURL":"http://www.cs.colostate.edu/~tmalmst/CT310-P3/awake.php", "petsListURL":"http://www.cs.colostate.edu/~tmalmst/CT310-P3/petList.php" };

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


function getStatus() {
    var status;
    http = new ajax_request();
    http.open("GET", vurl, true);
    http.onreadystatechange = function() {
	if (http.readyState == 4 && http.status == 200) {
	    status = JSON.parse( http.responseText );
	    // console.log( status );
	    statusToTable( status );
	   }
    }
    http.send( null );
}

function statusToTable(status) {
    var tab = document.getElementById('status_table');
    var i = tab.rows.length;
    for (j = 0; j < status.length; j++) {
	     var rt = "<tr> <td>" + status[j].siteName + "</td> <td>" + status[j].awakeURL
	      + "</td> <td>" + status[j].petsListURL + "</td> <td></td></tr>";
	     var rr = tab.insertRow(i);
	    rr.innerHTML = rt;
      update_status( status[j].awakeURL, rr )
    }
}

function update_status( siteStatus, cr ){
  // console.log("this is the siteStatus = " + siteStatus);
  var awake_status;
  $.ajax({
      type: "GET",
      url: siteStatus,
      dataType: "json",
      success: function (response) {
        console.log(typeof(response.status));
        show_color( response.status, cr );
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log("AJAX call was unsucessful.");
        $(cr.cells[3]).css('background-color','red');
      }
    });

}


function show_color(some_response, cr){
    // console.log( some_response );
    if( some_response  == "up"){
      $(cr.cells[3]).css('background-color', 'green'); // table row ID
    }
    if( some_response  == "down" ){
      $(cr.cells[3]).css('background-color', 'yellow'); // table row ID
    }
    if(some_response == undefined ){
      $(cr.cells[3]).css('background-color','red'); // multiple css properties jquery.
    }
}

function masterAPI() {
    getStatus();
}
