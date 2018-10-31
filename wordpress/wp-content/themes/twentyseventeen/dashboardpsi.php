
<?php /* Template Name: Dashboard - PSI */ ?>
<?php include 'header-dashboard.php';?>
<?php include 'side-menu.php';?>
<?php
	//add this in every page that needs login
	session_start();
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
			document.getElementById("update-event").style.display = "block";
			document.getElementById("psi").style.display = "block";
			document.getElementById("dengue").style.display = "block";
			document.getElementById("genPsi").style.display = "none";
			document.getElementById("genDengue").style.display = "none";
		</script>
	<?php	
	}
?>
<div class="page-content" id="googleMap" style="width:90%; height:520px"></div>

<table id="psitable">
	<tr>
		<td>PSI Value</td>
		<td>Air Quality Descriptor</td>
	</tr>
	<tr style = "color:green">
		<td>0 - 50</td>
		<td>Good</td>
	</tr>
	<tr style = "color:blue">
		<td>51 - 100</td>
		<td>Moderate</td>
	</tr>
	<tr style = "color:#CCCC00">
		<td>101 - 200</td>
		<td>Unhealthy</td>
	</tr>
	<tr style = "color:orange">
		<td>201 - 300</td>
		<td>Very unhealthy</td>
	</tr>
	<tr style = "color:red">
		<td>Above 300</td>
		<td>Hazardous</td>
	</tr>
</table>

<table id="nationalpsitable">
	<tr>
		<td colspan="2">National PSI Value</td>
	</tr>
	<tr>
		<td>PSI:</td>
		<td id="nationalPsiValue0"></td>
	</tr>
	<tr>
		<td>PM2.5:</td>
		<td id="nationalPsiValue25"></td>
	</tr>
	<tr>
		<td>PM10:</td>
		<td id="nationalPsiValue10"></td>
	</tr>
</table>




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
          <p>Create new case</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<?php include 'footer-dashboard.php';?>