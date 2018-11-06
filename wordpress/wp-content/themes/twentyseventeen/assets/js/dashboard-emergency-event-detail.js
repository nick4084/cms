$(document).ready(function(){
$("#editEventForm").on("submitupdate",function(e){
	e.preventDefault();
	if($("#editEventForm [name='edit-event-title']").val() === '')
	{
		//$("#contact-form [name='your_name']").css("border","1px solid red");
	}
	if ($("#editEventForm [name='edit-event-date']").val() === '')
	{
		
	}
	if ($("#editEventForm [name='edit-event-type']").val() === '')
	{
		
	}
	if ($("#editEventForm [name='edit-event-status']").val() === '')
	{
		
	}
	if ($("#editEventForm [name='edit-event-details']").val() === '')
	{
		
	}
var sendData = $( this ).serializeArray();
sendData.push({name: 'function', value: 'UpdateEvent'});
$.ajax({
	type: "POST",
	url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/event-manager.php",
	data: sendData,
	success: function(data){
			
			//$('#addEventModal').modal('hide');	
	}
 
});
});
$( "#deleteEvent" ).click(function deleteEvent(){
	var sendData = $( this ).serializeArray();
	sendData.push({name: 'function', value: 'deleteEvent'});
	sendData.push({name: 'edit-event-id', value: $('#editEventId').val()});
	$.ajax({
		type: "POST",
		url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/event-manager.php",
		data: sendData,
		success: function(data){
			window.location.href = "http://localhost/cms/wordpress/dashboard-emergency-event/";
				//$('#addEventModal').modal('hide');	
		}
	 
	});
});
$("#contact-form input").blur(function(){
var checkValue = $(this).val();
if(checkValue != '')
{
$(this).css("border","1px solid #eeeeee");
}
});
});
