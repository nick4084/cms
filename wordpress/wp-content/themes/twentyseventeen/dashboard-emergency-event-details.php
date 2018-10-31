<?php /* Template Name: Dashboard-emergency-event-details */ ?>
<?php include 'header-dashboard.php';?>
<?php include 'side-menu.php';?>
<?php include 'class_event.php';?>
<?php //add this in every page that needs login
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
			document.getElementById("psi").style.display = "block";
			document.getElementById("dengue").style.display = "block";
			document.getElementById("genPsi").style.display = "none";
			document.getElementById("genDengue").style.display = "none";
		</script>
	<?php	
	}
?>
<div class="page-content" style="width:90%; height:900px;">
<?php
        $current_event = new Event();
        $current_event->loadEventById($_GET['id'])?>
    <!-- top component -->
    <h2>Emergency event details</h2><br>
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<span><h3 class="panel-title">Event Information</h3></span>
        	
        </div>
        <div class="panel-body">
        <form id="editEventForm" method="post">
			<div class="form-group row">
				<label for="edit-event-title" class="col-sm-2 col-form-label">Title</label>
				<div class="col-sm-10">
					<input class="form-control" id="editEventTitle"
						name="edit-event-title" type="text"
						value="<?php echo $current_event->getTitle(); ?>">
					<input id="editEventId"
						name="edit-event-id" type="hidden"
						value="<?php echo $_GET['id']; ?>">
				</div>
			</div>

			<div class="form-group row">
				<label for="edit-event-date" class="col-sm-2 col-form-label">Date</label>
				<div class="col-sm-10">
					<input class="form-control" id="editEventDate"
						name="edit-event-date" type="date"
						value="<?php echo $current_event->getDate_time();?>">
				</div>
			</div>

			<div class="form-group row">
				<label for="edit-event-type" class="col-sm-2 col-form-label">Type</label>
				<div class="col-sm-10">
					<select id="editEventType"  class="form-control" name="edit-event-type"><option value="Dengue"<?php if ($current_event->getType()== 'Dengue') echo ' selected="selected"'; ?>>Dengue</option></select>
				</div>
			</div>

			<div class="form-group row">
				<label for="edit-event-status" class="col-sm-2 col-form-label">Status</label>
				<div class="col-sm-10">
					<select id="editEventStatus" name="edit-event-status"
						class="form-control">
						<option value="Active"
							<?php if ($current_event->getType()== 'Active') echo ' selected="selected"'; ?>>Active</option>
						<option value="Closed"
							<?php if ($current_event->getType()== 'Closed') echo ' selected="selected"'; ?>>Closed</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="edit-event-details" class="col-sm-2 col-form-label">Details</label>
				<div class="col-sm-10">
					<input class="form-control" id="editEventDetails"
						name="edit-event-details" type="text"
						value="<?php echo $current_event->getDetails();?>">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-10">
					<button type="button" id="deleteEvent" class="btn btn-danger">Delete this Event</button><button type="submit" class="btn btn-success">Save Changes</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	
    <!-- Updates holder -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<span><h3 class="panel-title">Event Updates</h3></span>
		</div>
		<div class="panel-body">
		content</div>
	</div>
	
	<!-- task holder -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<span><h3 class="panel-title">Event Tasks</h3></span>
		</div>
		<div class="panel-body">
		content
		</div>
	</div>
</div>

<?php include 'footer-dashboard.php';?>