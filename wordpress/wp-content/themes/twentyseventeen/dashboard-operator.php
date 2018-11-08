<?php /* Template Name: Dashboard - Operator */ ?>
<?php include 'header-dashboard.php';?>
<?php include 'list-of-cases.php';?>
<?php include 'operator-manager.php';?>
<?php
	//add this in every page that needs login
	if(!isset($_SESSION)){
		session_start();
	}
	$username = $_SESSION['MM_Username'];
	$role = $_SESSION['role'];
    $url = $_SESSION['defaulturl'];	
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
		</script>
	<?php	
	}
?>

<div class="page-content" id="googleMap" style="width:72%; height:520px;margin-left:28%;"></div>
<!--width 75% margin-left26%-->
<div class="wrapper">
<button id="addCaseBtn" type="button" class="circle float-button" data-toggle="modal" data-target="#addCaseModal" style = "background-color: #00ff00;display: <?php echo ($_SESSION["role"]!="Call_Operator") ? "none": "block"; ?>;"><div class="fas fa-plus"><span class="name"></span></div></button>

</div>

<!-- Modal -->
  <div class="modal fade" id="addCaseModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Case</h4>
        </div>
		<form id="newCaseForm" method="post" onsubmit="return validateForm()">
			<div class="modal-body">
			
				<div class="form-group">
					<label for="typeOfCase">Type of Case:</label>
					<select class="form-control" id="ddl_typeOfCase" name="ddl_typeOfCase">
						<option value="PSI">PSI</option>
						<option value="Dengue">Dengue</option>
					</select>
				</div>
				<div class="form-group">
					<label for="name">*Name:</label>
					<input type="text" id="tb_name" name="tb_name" class="form-control" required autofocus>
				</div>
				<div id="pc_div" class="form-group">
					<label for="postalCode">*Postal Code:</label>
					<input type="number" id="tb_postalCode" name="tb_postalCode" oninput="validity.valid||(value='');" onfocusout="validateAddr()" class="form-control" required>
					<label style="display: none; text-align: right; color:red;" id="error_msg_pc">Invalid postal code entered!</label>
				</div>
				<div class="form-group">
					<label for="numOfCase">*Number of cases in this area:</label>
					<input type="number" id="tb_numOfCase" name="tb_numOfCase" min="0" default="1" oninput="validity.valid||(value='');" class="form-control" required>
				</div>
				<div id="contact_div" class="form-group">
					<label for="name">*Contact:</label>
					<input type="number" id="tb_contact" name="tb_contact" oninput="validity.valid||(value='');" class="form-control" onfocusout="validateContact()" required>
					<label style="display: none; text-align: right; color:red;" id="error_msg_contact">Contact must have 8 digits!</label>
				</div>
				<div class="form-group">
					<label for="name">Remarks:</label>
					<textarea id="ta_remarks" name="ta_remarks" rows="10" cols="30" class="form-control"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button id="cancelBtn" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<input id="submitBtn" name="submitBtn" type="submit" class="btn btn-primary">
			</div>
		</form>
      </div>
    </div>
  </div>
<?php include 'footer-dashboard.php';?>