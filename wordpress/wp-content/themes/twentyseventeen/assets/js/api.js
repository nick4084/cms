var markerList = new Array();
var map, infowindow;

window.onload = getPSIApi;

function getPSIApi() {
	
	// Create a request variable and assign a new XMLHttpRequest object to it.
	var request = new XMLHttpRequest();

	// Open a new connection, using the GET request on the URL endpoint
	request.open('GET', 'https://api.data.gov.sg/v1/environment/psi?date=2018-10-29', true);

	console.log("API RU");
	console.log("RUN");
	
	request.onload = function () {
		// Begin accessing JSON data here
		var data = JSON.parse(this.response);
		var i = 0;
		console.log("FUNCTION IN");
		console.log("DATA EMPTY" + !data);
		console.log(data);
		console.log(data.region_metadata[0].label_location.longitude);
		console.log(data.items[0].readings.pm10_twenty_four_hourly);
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
				//National
				console.log("NationalPSI START");

				var nationalPSI = psiReading.national;
				var nationalPSI25 = pm25Reading.national;
				var nationalPSI10 = pm10Reading.national;
				
				console.log(nationalPSI);
				console.log(nationalPSI25);
				console.log(nationalPSI10);
				console.log("NationalPSI END");
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




