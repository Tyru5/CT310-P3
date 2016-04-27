// Tyrus Malmstrom
//All code to handle the ajax call to the masterAPI page:

var vurl = 'https://www.cs.colostate.edu/~ct310/yr2016sp/more_assignments/project03masterlist.php'; // page that has the master List
var http = false;
var request_awake = false;

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
			console.log( status );
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
				+ "</td> <td>" + status[j].petsListURL + "</td> <td class=\"statusColor\"></td></tr>";
		var rr = tab.insertRow(i);
		rr.innerHTML = rt;
		update_status( status[j].awakeURL, i );
	}
}

function update_status( siteStatus , numRows){
	request_awake = new ajax_request();
	var awake_url = siteStatus;
	var response;
	console.log("The awake url is = " + awake_url);
	console.log("This is i = " + numRows);
	for(j = 0; j < numRows; j++){
	request_awake.open("GET", awake_url, true);
	request_awake.onreadystatechange = function() {
		if (request_awake.readyState == 4 && request_awake.status == 200) {
			response = JSON.parse( request_awake.responseText );
			console.log( response );
		}
	}
	request_awake.send( null );
		if( response == "up"){
			$('.statusColor').css('background-color', 'green');
		}else if( response == "down" ){
			$('.statusColor').css('background-color', 'yellow');
		}else{
			$('.statusColor').css('background-color', 'red');
		}
	}
}

function masterAPI() {
	getStatus();
}
