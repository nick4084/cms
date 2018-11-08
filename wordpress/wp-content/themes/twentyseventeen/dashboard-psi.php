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
			document.getElementById("psi").style.display = "block";
			document.getElementById("dengue").style.display = "block";
		</script>
	<?php	
	}
?>
<div class="page-content" id="googleMap" style="width:90%; height:505px"></div>

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
<?php include 'footer-dashboard.php';?>