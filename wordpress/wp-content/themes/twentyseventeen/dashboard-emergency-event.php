<?php /* Template Name: Dashboard-emergency-event */ ?>
<?php include 'header-dashboard.php';?>
<?php include 'side-menu.php';?>

<div class="page-content"><!-- content section -->
<h2>Emergency Events</h2>
<table id="eventTable" class="display">
    <thead>
            <tr>
            	<th>#</th>
                <th>Title</th>
                <th>Date started</th>
                <th>Details</th>
                <th>Updates</th>
                <th>Tasks</th>
                <th>Type</th>
                <th>Status</th>
                <th></th>
            </tr>
    </thead>
    <tbody>

    </tbody>
</table>
</div>

<div class="wrapper">
	<button type="button" class="circle float-button" data-toggle="modal" data-target="#addEventModal" style = "background-color: #00ff00;"><div class="fas fa-plus"><span class="name"></span></div></button>
</div>

<!-- Modal -->
  <div class="modal fade" id="addEventModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Event</h4>
        </div>
        <div class="modal-body">
          <h2>Create new Emergency Event</h2>
          <form id="NewEventForm" action="#" method="post">
          	<div class="form-row"><label>Title:</label><input id="newEventTitle" name="new-event-title" type="text"></div>
        	<div class="form-row"><label>Date:</label><input id="newEventDate" name="new-event-date"  type="date"></div>
        	<div class="form-row"><label>Type:</label><select id="newEventType" name="new-event-type"></div>
    													<option value="Dengue">Dengue</option>
  													  	</select>
  		    <div class="form-row"><label>Status:</label><select id="newEventStatus" name="new-event-status">
    														<option value="Active">Active</option>
    														<option value="Closed">Closed</option>
    														</select>
    		<div class="form-row"><label>Details:</label><input id="newEventDetails" type="text"  name="new-event-details" >
    		
    		<div class="modal-footer">
          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          		<input id="submit" type="submit" class="btn btn-default">
        	</div>
        </form>
        </div>
      </div>
      
    </div>
  </div>
<?php include 'footer-dashboard.php';?>