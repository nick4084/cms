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
    $url = $_SESSION['defaulturl'];	
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

<div class="page-content" id="googleMap" style="width:75%; height:520px;margin-left:26%;"></div>

<div class="wrapper">
<button type="button" class="circle float-button" data-toggle="modal" data-target="#addCaseModal" style = "background-color: #00ff00;"><div class="fas fa-plus"><span class="name"></span></div></button>

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
        <div class="modal-body">
			<form id="asd" method="post">
			<table id="caseFormTable">
				<tr>
					<td>Type of Case: </td>
					<td>
						<select id="ddl_typeOfCase" name="ddl_typeOfCase">
							<option value="PSI">PSI</option>
							<option value="Dengue">Dengue</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>*Name: </td>
					<td><input type="text" id="tb_name" name="tb_name" required></td>
				</tr>
				<tr>
					<td>*Postal Code: </td>
					<td><input type="number" id="tb_postalCode" name="tb_postalCode" oninput="validity.valid||(value='');" required></td>
				</tr>
				<tr>
					<td>*Number of cases in this area: </td>
					<td><input type="number" id="tb_numOfCase" name="tb_numOfCase" min="0" default="1" oninput="validity.valid||(value='');" required></td>
				</tr>
				<tr>
					<td>*Contact: </td>
					<td><input type="number" id="tb_contact" name="tb_contact" oninput="validity.valid||(value='');" required></td>
				</tr>
				<tr>
					<td>Remarks: </td>
					<td>
						<textarea id="ta_remarks" name="ta_remarks" rows="10" cols="30"></textarea>
					</td>
				</tr>
			</table>
		</div>
		<div class="modal-footer">
			<input id="submitBtn" name="submitBtn" type="submit" class="btn btn-default">
			<button id="cancelBtn" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		</div>
		</form>
      </div>
    </div>
  </div>
<?php include 'footer-dashboard.php';?>