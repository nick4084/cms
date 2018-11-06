var markerList = new Array();
var infowindowList = new Array();
var map, infowindow;

//Run this javascript file only in dashboard-operator
if(window.location.href == "http://localhost/cms/wordpress/dashboard-operator/")
{
	
	var tb_name = document.getElementById("tb_name");
	var tb_postalCode = document.getElementById("tb_postalCode");
	var tb_numOfCase = document.getElementById("tb_numOfCase");
	var tb_contact = document.getElementById("tb_contact");
	var ta_remarks = document.getElementById("ta_remarks");

	//Limit to 6 numbers only
	tb_postalCode.onkeypress = function(){
	  console.log(this.value.length)
	  if(this.value.length>5)
		return false;
	}

	//Limit to 8 numbers only
	tb_contact.onkeypress = function(){
	  console.log(this.value.length)
	  if(this.value.length>7)
		return false;
	}
	
	retrieveAllCases();
}

function retrieveAllCases()
{

	//To access the cases retrieved from database
	var sendData = $( this ).serializeArray();
	sendData.push({name: 'function', value: 'retrieveCase'});
	$.ajax({
		type: "POST",
		url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/operator-manager.php",
		data: sendData,
		dataType: "json",
		success: function(data){
			//$("#loading-img").css("display","none");
			//$(".response_msg").text(data);
			//$(".response_msg").slideDown().fadeOut(3000);
			$('#listOfCaseSideMenu').delegate('li','click', listCaseClicked);
			setMapOnAll(null); //clear all markers before adding markers again
			for (i = 0; i<data.length;i++)
			{
				var test1 = $('#content1').html(data[0]);
				console.log(test1);
				console.log(data[0][0]);
				insertCaseMarkers(data[i][0], data[i][1], data[i][2], data[i][3], data[i][4], data[i][5]);
				displayListOfCases(data[i][0], data[i][1], data[i][2], data[i][3], data[i][4], data[i][5]);
			}
			//$("#NewEventForm [name='new-event-details']").val(data);
		}
	 
	});

}

function insertCaseMarkers(case_name, type_of_case, postal_code, num_of_cases, contact, remarks)
{
	var lat;
    var lng;
	var latLng;
	var marker;
    var address = postal_code;
	var centerOfSG = {lat: 1.35735, lng: 103.82};
	
	map = new google.maps.Map(document.getElementById('googleMap'), {zoom: 11.5, center: centerOfSG});
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) 
		{
			
			lat = parseFloat(results[0].geometry.location.lat());
			lng = parseFloat(results[0].geometry.location.lng());
			
			latLng = {lat: parseFloat(lat), lng: parseFloat(lng)};
			
			marker = new google.maps.Marker({
				position: latLng,
				map: map,
				title: case_name
			});

			//Create a listener to open a small window on mouseover. If want to change to onclick, type 'click'
			marker.addListener('mouseover', function() {
				infowindow = new google.maps.InfoWindow()
				
				infowindow.setContent('<p>'+ case_name +'</p>' +
									'<p>TypeOfCase:	' + type_of_case + '</p>'+
									'<p>postal_code:	' + postal_code + '</p>'+
									'<p>num_of_cases:	' + num_of_cases + '</p>'+
									'<p>contact:	' + contact + '</p>'+
									'<p>remarks:	' + remarks + '</p>');
				infowindow.open(map, this);
				//Store each infowindow into the array
				infowindowList.push(infowindow);
			});
	
			//This make sure that the window is close if the mouse is not on the marker
			marker.addListener('mouseout', function() {
				infowindow.close();
			});
			
			//Store each marker in an array	
			markerList.push(marker);
			
		}
	});
	
}

function displayListOfCases(case_name, type_of_case, postal_code, num_of_cases, contact, remarks)
{
	$(document).ready(function() {
		
		$('#listOfCaseSideMenu').append('<li><a><p>'+ case_name + '</p>' +
									'<p>TypeOfCase:	' + type_of_case + '</p>'+
									'<p>postal_code:	' + postal_code + '</p>'+
									'<p>num_of_cases:	' + num_of_cases + '</p>'+
									'<p>contact:	' + contact + '</p></a></li>');
	});
	
}

function listCaseClicked() {
  var marker = markerList[$(this).index()-1];
  map.panTo(marker.getPosition());
  
  //Close all infowindow first
  for (var i = 0; i<infowindowList.length;i++)
  {
	  infowindowList[i].close();
  }
  //Than display current infowindow
  google.maps.event.trigger(marker, 'mouseover');
  
}




