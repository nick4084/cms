$(document).ready(function(){
$("#NewUpdateForm").on("submit",function(e){
	e.preventDefault();

	if ($("#NewUpdateForm [name='new-update-date']").val() === '')
	{
		
	}
	if ($("#NewUpdateForm [name='new-update-comments']").val() === '')
	{
		
	}
	if($("#NewUpdateForm [name='new-update-id']").val() === '')
	{
		//$("#contact-form [name='your_name']").css("border","1px solid red");
	}
	if ($("#NewUpdateForm [name='new-update-user']").val() === '')
	{
		
	}
	

var event_id = $("#NewUpdateForm [name='new-update-id']").val();
var sendData = $( this ).serializeArray();
console.log(sendData);
sendData.push({name: 'function', value: 'CreateUpdate'});

$.ajax({
	type: "POST",
	url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/update-manager.php",
	data: sendData,
	success: function(data){
		$('#addUpdateModal').modal('hide');
		window.location.href = "http://localhost/cms/wordpress/dashboard-emergency-event-details/?id=" + event_id;
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