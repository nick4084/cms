<?php /* Template Name: Dashboard-emergency-event-details */ ?>
<?php include 'header-dashboard.php';?>
<?php include 'side-menu.php';?>
<?php include 'class_event.php';?>
<?php include 'class_update.php'; ?>
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
		</script>
	<?php	
	}
?>
<div class="page-content" style="width: 90%; height: 900px;">
<?php
        $current_event = new Event();
        $current_event->loadEventById($_GET['id'])?>
		

<?php
     $current_update = new Update();
	 $updatearray = array();
	 $updatearray = $current_update->loadUpdateById($_GET['id']);
	 date_default_timezone_set('Asia/Singapore');
	 $date = date('Y-m-d H:i:s', time());
   
?>

		<?php
        $current_task = new Task();

		
		list($a,$b) =$current_task->loadTaskById($_GET['id']);
		//var_dump($a);
		//var_dump($b);
			
		
		?>
		

    <!-- top component -->
	<h2>Emergency event details</h2>
	<br>
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
							<input
							id="editEventId" name="edit-event-id" type="hidden"
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
						<select id="editEventType" class="form-control"
							name="edit-event-type"><option value="Dengue"
								<?php if ($current_event->getType()== 'Dengue') echo ' selected="selected"'; ?>>Dengue</option></select>
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
							name="edit-event-details" type="text" style="height: 300dp;"
							value="<?php echo $current_event->getDetails();?>">
					</div>
				</div>
				<div class="form-group row">
				<label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
					<?php echo ($_SESSION["role"]==="NEA_Manager") ? 
						"<button type=\"button\" class = \"btn btn-danger right\" data-toggle=\"modal\" data-target=\"#deleteEventModal\">Delete Event</button>".
						"<button type=\"submit\" class=\"btn btn-success right\">Save Changes</button>"
						: ""; ?>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal fade" id="deleteEventModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 class="modal-title">Delete Event confirmation. (event #<?php echo $_GET['id'];?>)</h2>
				</div>
				<div class="modal-body">
					<h4>Are you sure you want to delete this Event?</h4>
					<h4>This Action cannot be reversed.</h4>
				</div>
				<div class="modal-footer">
          			<button type="button" class="btn btn-error" data-dismiss="modal">Cancel</button>
					<button type="button" id="deleteEvent" class="btn btn-danger">Delete</button>
        	</div>
			</div>

		</div>
	</div>


<!-- Updates holder -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<span><h3 class="panel-title">Event Updates</h3></span>
		</div>
		<div class="panel-body">
		<table class = "table table-condensed">
        	<thead>
        	<tr>
        		<th class ="col-md-1">Update#</th>
        		<th>Date and Time updated</th>
        		<th>Comments</th>
        		<th>Updated by </th>
        		</thead>
        		<tbody>
        		
        		<?php 
        		
        		foreach ($updatearray as $row1){
        		    echo "<tr>";
        		    echo "<form action = 'http://localhost/cms/wordpress/wp-content/themes/twentyseventeen/update-manager.php' method ='post'>";
        		    echo "<input name = 'delete-update-id' type ='hidden' value = '".$row1[0]."'>";
       
        		    foreach ($row1 as $row2){
        		        
        		        echo "<td>";
        		        echo $row2;
        		        
        		        echo "</td>";
        		       
        		  
        		        
        		    }
        	
        		    echo "<td><button type='delete' style = 'background-color: #DC143C;'><div class='fas fa-trash-alt'><span class='name'></span></div></button></td>";
        		    echo "</form>";
        		}
        	
        		
        		
        		
        		
        		
        		?>
        		</tbody>
        	<td></td>
        	
        	</tr>
        </table>
        <button type="button" class = "btn btn-success right" data-toggle="modal" data-target="#addUpdateModal";"><span class="name">Add new update</span></button>
        </div>
        <div class="form-group row">
				<div class="wrapper">
	
</div>

<!-- Modal -->
  <div class="modal fade" id="addUpdateModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Adding new updates for event #<?php echo $_GET['id'];?></h2>
        </div>
        <div class="modal-body">
          <form id="NewUpdateForm" action="#" method="post">
          <input type='hidden' name = "new-update-id" id= "newUpdateID" value = '<?php echo $_GET['id']?>'/>
			<div class="form-group row">
				<label for="new-update-date" class="col-sm-2 col-form-label">Date</label>
				<div class="col-sm-10">
					<?php echo $date;?>
					<input  type='hidden' id="newUpdateDate"
						name="new-update-date" value = '<?php echo $date;?>'/>
				</div>
			</div>
			<div class="form-group row">
				<label for="new-update-comment" class="col-sm-2 col-form-label">Comments</label>
				<div class="col-sm-10">
					<textarea id="newUpdateComments" name="new-update-comments" rows ="8" cols= "60"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="new-event-status" class="col-sm-2 col-form-label">Updated by:</label>
				<div class="col-sm-10">
					<?php echo $username;?>
					<input type ='hidden' name = "new-update-user" id = "newUpdateUser" value = "<?php echo $username; ?>"/>
				</div>
			</div>
			<div class="modal-footer">
          		<button type="button" class="btn btn-error" data-dismiss="modal">Cancel</button>
          		<input id="submitupdate" type="submit" class="btn btn-success">
        	</div>
        </form>
        </div>
      </div>
      
    </div>
  </div>
			</div>
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