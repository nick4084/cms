$(document).ready(function(){
	//DataTable
	$.ajax({
		type: "POST",
		url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/event-manager.php",
		dataType: "json",
        //async:false,
        data: {
            'function': "getEvents"
        },
		success: function(data){
			if(data.success == true){
				$('#eventTable').DataTable({
					data:data.dataset
				});
				$('#eventTable tbody').on( 'click', 'tr', function () {
					window.location.href = "http://localhost/cms/wordpress/dashboard-emergency-event-detail/";
			    });
			}
				
			}
	});
$("#NewEventForm").on("submit",function(e){
	e.preventDefault();
	if($("#NewEventForm [name='new-event-title']").val() === '')
	{
		//$("#contact-form [name='your_name']").css("border","1px solid red");
	}
	if ($("#NewEventForm [name='new-event-date']").val() === '')
	{
		
	}
	if ($("#NewEventForm [name='new-event-type']").val() === '')
	{
		
	}
	if ($("#NewEventForm [name='new-event-status']").val() === '')
	{
		
	}
	if ($("#NewEventForm [name='new-event-details']").val() === '')
	{
		
	}

var sendData = $( this ).serializeArray();
sendData.push({name: 'function', value: 'insertEvent'});
$.ajax({
	type: "POST",
	url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/event-manager.php",
	data: sendData,
	success: function(data){
		//if(data=="Connected successfully"){
			$('#addEventModal').modal('hide');
		//} else {
			
		//}
		//$("#loading-img").css("display","none");
		//$(".response_msg").text(data);
		//$(".response_msg").slideDown().fadeOut(3000);
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