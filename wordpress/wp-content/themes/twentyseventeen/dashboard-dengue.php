
<?php /* Template Name: Dashboard - Dengue */ ?>
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
<iframe id="dengue-container" width="100%" height="520px" src="https://data.gov.sg/dataset/dengue-clusters/resource/ce15cf3c-702c-4573-96db-69c50e6cb7f8/view/7bb2a106-0e86-4f18-873b-726bb5b6f922" frameBorder="1"></iframe>

<?php include 'footer-dashboard.php';?>