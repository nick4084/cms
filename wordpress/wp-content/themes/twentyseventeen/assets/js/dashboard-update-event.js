$(document).ready(function(){
$("#NewUpdateForm").on("submit",function(e){
	e.preventDefault();
	if($("#NewUpdateForm [name='new-update-ID']").val() === '')
	{
		//$("#contact-form [name='your_name']").css("border","1px solid red");
	}
	if ($("#NewUpdateForm [name='new-update-date']").val() === '')
	{
		
	}
	if ($("#NewUpdateForm [name='new-update-comments']").val() === '')
	{
		
	}
	
var sendData = $( this ).serializeArray();
sendData.push({name: 'function', value: 'CreateUpdate'});
$.ajax({
	type: "POST",
	url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/update-manager.php",
	data: sendData,
	success: function(data){
		$("#loading-img").css("display","none");
		$(".response_msg").text(data);
		$(".response_msg").slideDown().fadeOut(3000);
		//$("#NewUpdateForm [name='new-update-comments']").val(data);
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