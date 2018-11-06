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

$("#NewTaskForm").on("submit",function(e){
	e.preventDefault();
	if($("#NewTaskForm [name='new-action-scope']").val() === '')
	{
		//$("#contact-form [name='your_name']").css("border","1px solid red");
	}
	if ($("#NewTaskForm [name='new-status']").val() === '')
	{
		
	}


var sendData = $( this ).serializeArray();
sendData.push({name: 'function', value: 'insertTask'});
$.ajax({
	type: "POST",
	url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/task-manager.php",
	data: sendData,
	success: function(data){
		//if(data=="Connected successfully"){
			$('#addTaskModal').modal('hide');
		//} else {
			
		//}
		//$("#loading-img").css("display","none");
		//$(".response_msg").text(data);
		//$(".response_msg").slideDown().fadeOut(3000);
	}
 
});
});

$('.someClass').click(function updateTask() { 
	var sendData = $(this).serializeArray();
  sendData.push({name: 'function', value: 'updateTask'});
  sendData.push({name: 'edit-action-scope', value: $('#editActionScope').val()});
  sendData.push({name: 'edit-status', value: $('#editStatus').val()});
  sendData.push({name: 'edit-task-id', value: $('#new-task-id').val()});
  alert(x_id);
	$.ajax({
		type: "POST",
		url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/task-manager.php",
		data: sendData,
		success: function(data){

		}
	 
});	
});

$('.deleteClass').click(function deleteTask() { 
	var sendData = $(this).serializeArray();
  sendData.push({name: 'function', value: 'deleteTask'});
  sendData.push({name: 'edit-task-id', value: $('#new-task-id').val()});
  var e_id = $('#new-event-id').val();
	$.ajax({
		type: "POST",
		url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/task-manager.php",
		data: sendData,
		success: function(data){
				window.location.href = "http://localhost/cms/wordpress/dashboard-emergency-event-details/?id=" +e_id;
		}
	 
});	
});


$('a[data-role=update]').click(function(){
	var id = $(this).data('id');
	var action_scope = $('#'+id).children('td[data-target=action_scope]').text();
	var task_id = $('#'+id).children('td[data-target=task_id]').text();
	var status = $('#'+id).children('td[data-target=status]').text();
	
	
	$('#editActionScope').val(action_scope);
	$('#new-task-id1').val(task_id);
	$('#editTaskModal').modal('toggle');


});

$('a[data-role=delete]').click(function(){
	var id = $(this).data('id');
	var action_scope = $('#'+id).children('td[data-target=action_scope]').text();
	var task_id = $('#'+id).children('td[data-target=task_id]').text();
	var status = $('#'+id).children('td[data-target=status]').text();
	
	$('#new-task-id2').val(task_id);
	$('#deleteTaskModal').modal('toggle');



});

$('#DeleteTaskBtn').click(function Deletess(){
	var sendData = $( this ).serializeArray();
	var task_id = $('#new-task-id2').val();
	var event_id = $('#new-event-id2').val();
	
	alert(event_id);

	sendData.push({name: 'function', value: 'deleteTask'});
    sendData.push({name: 'edit-task-id',value:task_id });
	

		$.ajax({
		type: "POST",
		url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/task-manager.php",
		data: sendData,
		success: function(data){
				//$('#addEventModal').modal('hide');	
				window.location.href = "http://localhost/cms/wordpress/dashboard-emergency-event-details/?id=" + event_id;
		}
	 
	});
	
});



$('#UpdateTaskBtn').click(function updatess(){
	var sendData = $( this ).serializeArray();
	var task_id = $('#new-task-id1').val();
	var action_scope = $('#editActionScope').val();
	var statuss = $('#editStatus').val();
	var event_id = $('#new-event-id').val();
	
	sendData.push({name: 'function', value: 'updateTask'});
    sendData.push({name: 'edit-action-scope',value:action_scope });
    sendData.push({name: 'edit-status',value:statuss});
    sendData.push({name: 'edit-task-id',value:task_id });
	

		$.ajax({
		type: "POST",
		url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/task-manager.php",
		data: sendData,
		success: function(data){
				//$('#addEventModal').modal('hide');
			window.location.href = "http://localhost/cms/wordpress/dashboard-emergency-event-details/?id=" + event_id;
				
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

/*
$( "#deleteTask" ).click(function deleteTask(){
	var sendData = $( this ).serializeArray();
	sendData.push({name: 'function', value: 'deleteTask'});
	sendData.push({name: 'edit-task-id', value: $('#editTaskId').val()});
	$.ajax({
		type: "POST",
		url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/task-manager.php",
		data: sendData,
		success: function(data){
			window.location.href = "http://localhost/cms/wordpress/dashboard-emergency-event-details/?id=" + $('#editEvent1Id').val();
				//$('#addEventModal').modal('hide');	
		}
	 
	});
});
*/




$("#contact-form input").blur(function(){
var checkValue = $(this).val();
if(checkValue != '')
{
$(this).css("border","1px solid #eeeeee");
}
});
});


function updateData(str){
  var sendData = $(this).serializeArray();
  sendData.push({name: 'function', value: 'updateTask'});
  sendData.push({name: 'edit-action-scope', value: $('#editActionScope'+str).val()});
  sendData.push({name: 'edit-status', value: $('#editStatus'+str).val()});
  sendData.push({name: 'edit-task-id', value: $('#new-task-id'+str).val()});
  


  $.ajax({
		type: "POST",
		url: "http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/task-manager.php",
		data: sendData,
		success: function(data){
			  alert("I am an alert box!");
				//$('#addEventModal').modal('hide');	
		}
	 
	});
}

