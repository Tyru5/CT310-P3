// Tyrus Malmstrom
//All code to handle the ajax call to the masterAPI page:

var vurl = 'https://www.cs.colostate.edu/~ct310/yr2016sp/more_assignments/project03masterlist.php'; // page that has the master List
var http = false;

// code to handle working on IE:
if (navigator.appName == "Microsoft Internet Explorer") {
	http = new ActiveXObject("Microsoft.XMLHTTP");
} else {
	http = new XMLHttpRequest();
}

function getStatus() {
	var status;
	http.open("GET", vurl, true);
	http.onreadystatechange = function() {
		if (http.readyState == 4 && http.status == 200) {
			status = JSON.parse( http.responseText );
			console.log0( status );
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
		update_status( status[j].awakeURL );
	}
}

function update_status( siteStatus ){
	if( siteStatus[j].awakeURL == "up"){
		$('.statusColor').css('background-color', 'green');
	}else if( siteStatus[j].awakeURL == "down" ){
		$('.statusColor').css('background-color', 'yellow');
	}else{
		$('.statusColor').css('background-color', 'red');
	}
}

function masterAPI() {
	getStatus();
}
