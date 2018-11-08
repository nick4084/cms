var markerList = new Array(); //Store markers
var infowindowList = new Array(); //Store infowindows
var centerOfSG = {lat: 1.35735, lng: 103.82}; //Center of Singapore
var map = null;
var infowindow;
var postalCodeValid, contactValid;
var markerId = 1; //For putting each id into the title of the markers
var currentMarkerId = 0; //To get the marker who has the infowindow opened
var listClicked = false; //To control the auto scroll in the list

var listHtmlText ='<div class="card"><div class="container"><h4><b>Case Reported</b></h4></div></div>'; //Put the header of the list first
var idOfListItem = 0;

//Run this javascript file only in dashboard-operator
if(window.location.href == "http://localhost/cms/wordpress/dashboard-operator/")
{
	var tb_postalCode = document.getElementById("tb_postalCode");
	var tb_contact = document.getElementById("tb_contact");

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
	
	//Get all case from DB to display on map and list
	retrieveAllCases();
}

/*
	To check if the postal code entered is correct
	If less than 6 number OR no such postal code, display error.
*/
function validateAddr()
{
	var pc_div = document.getElementById("pc_div"); //Used to change the color of the textbox
	var error_msg_pc = document.getElementById("error_msg_pc"); //Error message
	var address = document.getElementById("tb_postalCode").value;
	var numOfDigitInPC = Math.floor(Math.log(address) / Math.LN10 + 1); //To get the number of digit, cannot use length for number
	if(numOfDigitInPC == 6)
	{
		var geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) 
			{
				postalCodeValid = true;
				pc_div.className = "form-group"; //Normal Textbox
				error_msg_pc.style.display = "none"; //Dont show error msg
			}
			else 
			{
				postalCodeValid = false;
				pc_div.className = "form-group has-error has-feedback"; //Textbox with red line
				error_msg_pc.style.display = "block"; //Show error msg
			}
		});
	}
	else
	{
		postalCodeValid = false;
		pc_div.className = "form-group has-error has-feedback"; //Textbox with red line
		error_msg_pc.style.display = "block"; //Show error msg
	}
}

/*
	To check if the contact entered is correct
	If the value entered is not exactly 8 digit, display error.
*/
function validateContact()
{
	var contact_div = document.getElementById("contact_div");
	var error_msg_contact = document.getElementById("error_msg_contact");
	var tb_contact = document.getElementById("tb_contact");
	var numOfDigitInContact = Math.floor(Math.log(tb_contact.value) / Math.LN10 + 1); //To get the number of digit, cannot use length for number

	if(numOfDigitInContact != 8)
	{
		contactValid = false;
		contact_div.className = "form-group has-error has-feedback";
		error_msg_contact.style.display = "block";
		
	}
	else
	{
		contactValid = true;
		contact_div.className = "form-group";
		error_msg_contact.style.display = "none";
	}
}

/*
	Run this method when user click submit.
	Dont allow inserting of DB if either postal code or contact is invalid
	Other field are automatically checked to see if they are empty
*/ 
function validateForm()
{
	if(postalCodeValid == false || contactInvalid == false)
	{
		alert("Some of the fields are incorrect!");
		return false;
	}
}

/*
	To retrieve all the case from the DB using operator-manager.php
*/
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
			$('#listOfCaseContainer').delegate('a','click', listCaseClicked); //To allow each item in the list to have onclick function
			if (map != null)
				setMapOnAll(null); //clear all markers before adding markers again
			for (i = 0; i<data.length;i++)
			{
				insertCaseMarkers(data[i][0], data[i][1], data[i][2], data[i][3], data[i][4], data[i][5]);
				displayListOfCases(data[i][0], data[i][1], data[i][2], data[i][3], data[i][4], data[i][5]);
			}
		} 
	});
}

//Insert one marker per case
function insertCaseMarkers(name, type_of_case, postal_code, num_of_cases, contact, remarks)
{
	var lat;
    var lng;
	var latLng;
	var marker;
    var address = postal_code;

	map = new google.maps.Map(document.getElementById('googleMap'), {zoom: 11.5, center: centerOfSG}); 
	
	//Convert the postal code into lat and lng
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
				title: markerId.toString()
			});
			
			markerId++; //For the next marker later
			//Create a listener to open a small window on mouseover. If want to change to onclick, type 'click'
			marker.addListener('mouseover', function() {
				
				//If the infowindow is opened, get the marker's id
				currentMarkerId = marker.getTitle();
				
				// InfoWindow content
				var content = '<div id="iw-container">' +
					'<div class="iw-title">' + name + ' (' + type_of_case + ')</div>' +
					'<div class="iw-content">' +
					'<div class="iw-subTitle">Postal Code</div>' +
					'<p>' + postal_code + '</p>' +
					'<div class="iw-subTitle">Number of Cases</div>' +
					'<p>' + num_of_cases + '</p>'+
					'<div class="iw-subTitle">Contact</div>' +
					'<p>' + contact + '</p>'+
					'<div class="iw-subTitle">Remarks</div>' +
					'<p>' + remarks + '</p>'+
					'</div>' +
					'<div class="iw-bottom-gradient"></div>' +
					'</div>';
									
									
				infowindow = new google.maps.InfoWindow({
				  content: content,
				  maxWidth: 330
				});
				
				editInfowindowCSS(infowindow);
				
				//Close all infowindow before opening a new one
				closeAllInfoWindow();
				infowindow.open(map, this);
				
				//Store each infowindow into the array
				infowindowList.push(infowindow);
				//If listClicked is true - User select the case from the list, no need auto scroll
				//If listClick is false - User mouseover the marker, auto scroll the list to the selected case
				if(listClicked == true)
					listClicked = false;
				else
					moveListToSelectedCase();
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

//Use Javascript to dynamically create a card for each case to appear in the list
function displayListOfCases(name, type_of_case, postal_code, num_of_cases, contact, remarks)
{
	listHtmlText += '<div class="card"><a id='+idOfListItem.toString()+'>'+ 
										'<h5><b>' + name + ' (' + type_of_case + ')</b></h5><div class="container">' + 
									'<p>Postal Code:	' + postal_code + '</p>'+
									'<p>Number of Cases:	' + num_of_cases + '</p>'+
									'<p>Contact:	' + contact + '</p></div></a></div>';
	idOfListItem++;
	$('#listOfCaseContainer').html(listHtmlText);
}

//Run this method when the user click one of the case in the list
function listCaseClicked() {
	listClicked = true;
	var marker = markerList[parseInt($(this).get(0).id,10)]; //Get the id from <a>
	map.panTo(marker.getPosition());
  
	//Close all infowindow first
	closeAllInfoWindow();
	
	//Than display current infowindow
	google.maps.event.trigger(marker, 'mouseover');
  
}

//Auto scroll function
function moveListToSelectedCase(){
	var index = parseInt(currentMarkerId,10)+1; //+1 is because the header is also counted as 1 of the child.
	$('#listOfCaseContainer').scrollTop(0).scrollTop($('#listOfCaseContainer div:nth-child('+index+')').position().top);
}

//Close all infowindow
function closeAllInfoWindow()
{
	for (var i = 0; i<infowindowList.length;i++)
	{
		infowindowList[i].close();
	}
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


