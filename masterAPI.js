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
			console.log(status);
			statusToTable(status);
		}
	}
	http.send( null );
}
function statusToTable(status) {
	var tab = document.getElementById('status_table');
	var i = tab.rows.length;
	for (j = 0; j < status.length; j++) {
		var rt = "<tr> <td>" + status[j].siteName + "</td> <td>" + status[j].awakeURL
				+ "</td> <td>" + status[j].petsListURL + "</td></tr>";
		var rr = tab.insertRow(i);
		rr.innerHTML = rt;
	}
}
function masterAPI() {
	getStatus();
}
