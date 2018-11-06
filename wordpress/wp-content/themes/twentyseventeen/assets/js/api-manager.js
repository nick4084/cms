var markerList = new Array();
var map, infowindow;

if(window.location.href == "http://localhost/cms/wordpress/dashboard-psi/")
	window.onload = getPSIApi;

function getPSIApi() {
	
	var date = getTodayDate();
	// Create a request variable and assign a new XMLHttpRequest object to it.
	var request = new XMLHttpRequest();

	// Open a new connection, using the GET request on the URL endpoint
	request.open('GET', 'https://api.data.gov.sg/v1/environment/psi?date=' + date, true);
	
	request.onload = function () {
		// Begin accessing JSON data here
		var data = JSON.parse(this.response);
		var i = 0;

		var centerOfSG = {lat: 1.35735, lng: 103.82};
		map = new google.maps.Map(document.getElementById('googleMap'), {zoom: 11.5, center: centerOfSG});
		
		var regionLocations = data.region_metadata;
		var items = data.items;
		
		for (i = 0; i<regionLocations.length;i++)
		{
			var lat = regionLocations[i].label_location.latitude;
			var lng = regionLocations[i].label_location.longitude;
			var latLng = {lat: lat, lng: lng};
			
			var name = regionLocations[i].name;
			
			var psiReading = items[i].readings.psi_twenty_four_hourly;
			var pm10Reading = items[i].readings.pm10_twenty_four_hourly;
			var pm25Reading = items[i].readings.pm25_twenty_four_hourly;
			var psi,pm10,pm25;
			
			if(i == 0)
			{
				var nationalPSI = psiReading.national;
				var nationalPSI25 = pm25Reading.national;
				var nationalPSI10 = pm10Reading.national;
				
				document.getElementById("nationalPsiValue0").appendChild(document.createTextNode(nationalPSI));
				document.getElementById("nationalPsiValue25").appendChild(document.createTextNode(nationalPSI25));
				document.getElementById("nationalPsiValue10").appendChild(document.createTextNode(nationalPSI10));
			}
			
			if (name == "central")
			{
				psi = psiReading.central;
				pm25 = pm25Reading.central;
				pm10 = pm10Reading.central;
			}
			else if(name == "east")
			{
				psi = psiReading.east;
				pm25 = pm25Reading.east;
				pm10 = pm10Reading.east;
			}
			else if (name == "north")
			{
				psi = psiReading.north;
				pm25 = pm25Reading.north;
				pm10 = pm10Reading.north;
			}
			else if (name == "south")
			{
				psi = psiReading.south;
				pm25 = pm25Reading.south;
				pm10 = pm10Reading.south;
			}
			else if (name == "west")
			{
				psi = psiReading.west;
				pm25 = pm25Reading.west;
				pm10 = pm10Reading.west;
			}
			createMarker(name, latLng, psi, pm25, pm10);			
		}	
	}
	
	// Send request
	request.send();
}



function createMarker(name, latLng, psi, pm25, pm10)
{
	//Create a marker
	var marker = new google.maps.Marker({
		position: latLng,
		map: map,
		title: name
	});
	
	//Create a listener to open a small window on mouseover. If want to change to onclick, type 'click'
	marker.addListener('mouseover', function() {
		infowindow = new google.maps.InfoWindow()
		
		infowindow.setContent('<p>'+ name +'</p>' +
							'<p>PSI:	' + psi + '</p>'+
							'<p>PM2.5:	' + pm25 + '</p>'+
							'<p>PM10:	' + pm10 + '</p>');
		infowindow.open(map, this);
	});
	
	//This make sure that the window is close if the mouse is not on the marker
	marker.addListener('mouseout', function() {
		infowindow.close();
	});
	
	//Not sure if need later, store each marker in an array	
	markerList.push(marker);
}

function getTodayDate()
{
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //As January is 0.
	var yyyy = today.getFullYear();

	if(dd<10) dd='0'+dd;
	if(mm<10) mm='0'+mm;
	
	return (yyyy + "-" + mm + "-" + dd);
}



