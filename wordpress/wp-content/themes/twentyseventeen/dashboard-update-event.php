<?php /* Template Name: Dashboard-update-event */ ?>
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
			document.getElementById("update-event").style.display = "block";
			document.getElementById("psi").style.display = "block";
			document.getElementById("dengue").style.display = "block";
			document.getElementById("genPsi").style.display = "none";
			document.getElementById("genDengue").style.display = "none";
		</script>
	<?php	
	}
?>

<?php $conn = new mysqli('localhost', 'root', '', 'cms');
// Check connection
function getConnecion(){
    $conn = new mysqli('localhost', 'root', '', 'cms');
    return $conn;
}
$query = "SELECT * FROM `cms_event`";
$result = mysqli_query ($conn, $query);
$query2 = "SELECT * FROM `cms_update`";
$result2 = mysqli_query ($conn, $query2);
?>

<div class="page-content">
<?php
echo "<table border='1'>";
echo "<tr><td>Date-of-update</td><td>EventComments</td><td>Updated_By</td><td>Event ID</td></tr>";
while ($display = mysqli_fetch_assoc($result2)){
	echo "<tr><td>{$display['date_time']}</td><td>{$display['post_comment']}</td><td>{$display['update_user']}</td><td>{$display['update_event_id']}</td></tr>";
}
	echo "</table>";
 ?>
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
          <h4 class="modal-title">New Updates</h4>
        </div>
        <div class="modal-body">
          <h2>Create new Updates</h2>
          <form id="NewUpdateForm" action="#" method="post">
          	<div class="form-row"><label>Emergency Event ID:</label><select id="newUpdateTitle" name="new-update-ID"></div>
														<option value ="0">Select Event</option>
														<?php while($row = mysqli_fetch_array($result)):; ?>
    													<option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>
														<?php endwhile; ?>
  													  	</select>
        	<div class="form-row"><label>Updated at:</label><input id="newUpdateDate" name="new-update-date"  type="datetime-local"></div>
        	
    		<div class="form-row"><label>Comments: </label><textarea id="newUpdateComments" name="new-update-comments" rows ="5" cols= "40"></textarea>
			
    		
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