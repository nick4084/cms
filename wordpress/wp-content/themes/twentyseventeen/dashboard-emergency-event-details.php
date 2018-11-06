<?php /* Template Name: Dashboard-emergency-event-details */ ?>
<?php include 'header-dashboard.php';?>
<?php include 'side-menu.php';?>
<?php include 'class_event.php';?>
<?php include 'class_task.php';?>

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
		
		<?php
        $current_task = new Task();

		
		list($a,$b) =$current_task->loadTaskById($_GET['id']);
		//var_dump($a);
		//var_dump($b);
			
		
		?>
		
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
		<div class="panel-heading clearfix"">
			<span><h3 class="panel-title pull-left">Event Tasks</h3></span>
			<div class="btn-group pull-right">
<button type="button" data-toggle="modal" data-target="#addTaskModal" style = "background-color: #00ff00;"><div class="fas fa-plus"><span class="name"></span></div></button>	

</div>		
		</div>
		<div class="panel-body">
		  <table class="table table-condensed">
        <thead>
            <tr>
                <th class="col-md-1">Task ID</th>
                <th>Action Scope</th>
				<th>Status</th>
				<th>Event ID</th>
			    <th>Assigned User</th>
            </tr>
        </thead>
        <tbody>
<?php
     $count = 0;

		foreach ($a as $v1) {
			echo "<tr id='".$v1[0]."'>";
    foreach ($v1 as $v2) {
        echo "<td";
		switch ($count) {
    case 0:
        echo " data-target='task_id'>";
        break;
    case 1:
        echo " data-target='action_scope'>";
        break;
    case 2:
        echo " data-target='status'>";
        break;
	case 3:
        echo ">";
        break;
	case 4:
        echo ">";
        break;
}
		echo $v2;
		echo "</td>";
		$count++;
    }
	$count =0;
	echo "<td><a href='#' data-role='update' data-id='".$v1[0]."'>Update</a></td>";
	echo "<td><a href='#' data-role='delete' data-id='".$v1[0]."'>Delete</a></td>";
	echo "</tr>";
}?>



      <!--  <tr>
		<form id="EditTaskForm" method="post">
		<input id="editTaskId" name="edit-task-id" type="hidden" value="">
		<input id="editEvent1Id" name="edit-event1-id" type="hidden" value="">
		<?php /*
		foreach ($b as $v1){
		echo "<td>"	;
        echo $v1;		
		echo "</td>";
		}  */
		?>
		<td><button type='button' style = 'background-color: #00ff00;'><div class='fas fa-pen'></button></td>
	    <td><button type='button' id='deleteTask' style = 'background-color: #00ff00;'><div class='fas fa-trash-alt'></button></td>
		</form>
		</tr> */ !-->



        </tbody>
    </table>
		</div>
	</div>
</div>

  <div class="modal fade" id="editTaskModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Update Tasks</h2>
        </div>
        <div class="modal-body">
          <form action="#" method="post">
			<div class="form-group row">
				<label for="new-action-scope" class="col-sm-2 col-form-label">ActionScope</label>
				<div class="col-sm-10">
					<input class="form-control" id="editActionScope"
						name="edit-action-scope" type="text">
				</div>
			</div>
			<div class="form-group row">
				<label for="new-status" class="col-sm-2 col-form-label">Status</label>
				<div class="col-sm-10">
					<select id="editStatus" name="edit-status"
						class="form-control">
						<option>In Progress</option>
						<option>Done</option>
					</select>
				</div>
			</div>
			 <input type="hidden" id="new-task-id1" name="new-task-id">
			 <input type="hidden" id="new-event-id" name="new-event-id" value="<?php echo $_GET['id'];?>" >	
    		<div class="modal-footer">
          		<button type="button" class="btn btn-error" data-dismiss="modal">Cancel</button>
          		<button type="button" id="UpdateTaskBtn" class="btn btn-primary"> Update </button>
        	</div>
        </form>
        </div>
      </div>
    </div>
	</div>

  
  <div class="modal fade" id="deleteTaskModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Do you want to delete Tasks</h2>
        </div>
        <div class="modal-body">
          <form action="#" method="post">
			 <input type="hidden" id="new-task-id2" name="new-task-id" >	
			 <input type="hidden" id="new-event-id2" name="new-event-id" value="<?php echo $_GET['id'];?>" >	

    		<div class="modal-footer">
          		<button type="button" class="btn btn-error" data-dismiss="modal">Cancel</button>
          		<button type="submit" id="DeleteTaskBtn" class="btn btn-primary"> Yes </button>
        	</div>
        </form>
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="modal fade" id="addTaskModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Create new Emergency Event</h2>
        </div>
        <div class="modal-body">
		<?php ?>
          <form id="NewTaskForm" action="#" method="post">
			<div class="form-group row">
				<label for="new-action-scope" class="col-sm-2 col-form-label">ActionScope</label>
				<div class="col-sm-10">
					<input class="form-control" id="newActionScope"
						name="new-action-scope" type="text">
				</div>
			</div>
			<div class="form-group row">
				<label for="new-status" class="col-sm-2 col-form-label">Status</label>
				<div class="col-sm-10">
					<select id="newStatus" name="new-status"
						class="form-control">
						<option>In Progress</option>
						<option>Done</option>
					</select>
				</div>
			</div>
			 <input type="hidden" id="new-task-id" name="new-task-id" value="<?php echo $_GET['id'] ?>">
			 <input type="hidden" id="new-assigned-user" name="new-assigned-user" value="<?php echo $username ?>">
			
    		<div class="modal-footer">
          		<button type="button" class="btn btn-error" data-dismiss="modal">Cancel</button>
          		<input id="submit" type="submit" class="btn btn-success">
        	</div>
        </form>
        </div>
      </div>
      
    </div>
  </div>
<?php include 'footer-dashboard.php';?>