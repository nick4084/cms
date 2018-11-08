var markerList = new Array();
var map, infowindow;

if(window.location.href == "http://localhost/cms/wordpress/dashboard-psi/" || window.location.href == "http://localhost/cms/wordpress/general-psi/")
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
		infowindow = new google.maps.InfoWindow();
		
		// InfoWindow content
		var content = '<div id="iw-container">' +
			'<div class="iw-title">' + name + '</div>' +
			'<div class="iw-content">' +
			'<div class="iw-subTitle">PSI</div>' +
			'<p>' + psi + '</p>' +
			'<div class="iw-subTitle">PM2.5</div>' +
			'<p>' + pm25 + '</p>'+
			'<div class="iw-subTitle">PM10</div>' +
			'<p>' + pm10 + '</p>'+
			'</div>' +
			'<div class="iw-bottom-gradient"></div>' +
			'</div>';
		
		/*infowindow.setContent('<p>'+ name +'</p>' +
							'<p>PSI:	' + psi + '</p>'+
							'<p>PM2.5:	' + pm25 + '</p>'+
							'<p>PM10:	' + pm10 + '</p>');*/
							
		infowindow.setContent(content);
		
		editInfowindowCSS(infowindow);
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

//For customising infowindow
function editInfowindowCSS(infowindow)
{
	// START INFOWINDOW CUSTOMIZE.
	// The google.maps.event.addListener() event expects
	// the creation of the infowindow HTML structure 'domready'
	// and before the opening of the infowindow, defined styles are applied.
	google.maps.event.addListener(infowindow, 'domready', function() {

		// Reference to the DIV that wraps the bottom of infowindow
		var iwOuter = $('.gm-style-iw');

		/* Since this div is in a position prior to .gm-div style-iw.
		 * We use jQuery and create a iwBackground variable,
		 * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
		*/
		var iwBackground = iwOuter.prev();

		// Removes background shadow DIV
		iwBackground.children(':nth-child(2)').css({'display' : 'none'});

		// Removes white background DIV
		iwBackground.children(':nth-child(4)').css({'display' : 'none'});

		// Moves the infowindow 115px to the right.
		//iwOuter.parent().parent().css({left: '115px'});

		// Moves the shadow of the arrow 76px to the left margin.
		iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

		// Moves the arrow 76px to the left margin.
		iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

		// Changes the desired tail shadow color.
		iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

		// Reference to the div that groups the close button elements.
		var iwCloseBtn = iwOuter.next();

		// Apply the desired effect to the close button
		iwCloseBtn.css({opacity: '1', right: '38px', top: '2px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
		iwCloseBtn.css({'display': 'none'});
		// If the content of infowindow not exceed the set maximum height, then the gradient is removed.
		if($('.iw-content').height() < 240){
		  $('.iw-bottom-gradient').css({display: 'none'});
		}

		// The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
		iwCloseBtn.mouseout(function(){
		  $(this).css({opacity: '1'});
		});
	});
	
}


