<?php /* Template Name: Dashboard-emergency-event */ ?>
<?php include 'header-dashboard.php';?>
<?php include 'side-menu.php';?>
<?php
	//add this in every page that needs login
	session_start();
	$username = $_SESSION['MM_Username'];
    $url = get_site_url(). "/";
	if( !isset($username))
	{
		header("Location:$url"); // variable not created ==> not login yet
	}
	else
	{?>
		<script language="javascript">
			document.getElementById("emergency-event").style.display = "block";
			document.getElementById("psi").style.display = "block";
			document.getElementById("dengue").style.display = "block";
		</script>
	<?php	
	}
?>
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
          <h2 class="modal-title">Create new Emergency Event</h2>
        </div>
        <div class="modal-body">
          <form id="NewEventForm" action="#" method="post">
          	<div class="form-group row">
				<label for="new-event-title" class="col-sm-2 col-form-label">Title</label>
				<div class="col-sm-10">
					<input class="form-control" id="newEventTitle"
						name="new-event-title" type="text"">
				</div>
			</div>
			<div class="form-group row">
				<label for="new-event-date" class="col-sm-2 col-form-label">Date</label>
				<div class="col-sm-10">
					<input class="form-control" id="newEventDate"
						name="new-event-date" type="date" value="<?php echo date('Y-m-d');?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="new-event-type" class="col-sm-2 col-form-label">Type</label>
				<div class="col-sm-10">
					<select id="newEventType"  class="form-control" name="new-event-type"><option>Dengue</option></select>
				</div>
			</div>
			<div class="form-group row">
				<label for="new-event-status" class="col-sm-2 col-form-label">Status</label>
				<div class="col-sm-10">
					<select id="newEventStatus" name="new-event-status"
						class="form-control">
						<option>Active</option>
						<option>Closed</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="new-event-details" class="col-sm-2 col-form-label">Details</label>
				<div class="col-sm-10">
					<input class="form-control" id="newEventDetails"
						name="new-event-details" type="text">
				</div>
			</div>
    		<div class="modal-footer">
          		<button type="button" class="btn btn-error right" data-dismiss="modal">Cancel</button>
          		<input id="submit" type="submit" class="btn btn-success right">
        	</div>
        </form>
        </div>
      </div>
      
    </div>
  </div>
<?php include 'footer-dashboard.php';?>