
<?php /* Template Name: pdfFile */ ?>
<link rel="stylesheet" href="/cms/wordpress/wp-content/themes/twentyseventeen/assets/css/dashboard-template.css">
<link rel="stylesheet" href="/cms/wordpress/wp-content/themes/twentyseventeen/assets/css/style.css">
<link rel="stylesheet" href="/cms/wordpress/wp-content/themes/twentyseventeen/assets/css/table-style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/solid.css" integrity="sha384-osqezT+30O6N/vsMqwW8Ch6wKlMofqueuia2H7fePy42uC05rm1G+BUPSd2iBSJL" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/fontawesome.css" integrity="sha384-BzCy2fixOYd0HObpx3GMefNqdbA7Qjcc91RgYeDjrHTIEXqiF00jKvgQG0+zY/7I" crossorigin="anonymous">
<script src="/cms/wordpress/wp-content/themes/twentyseventeen/assets/js/html2canvas.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src='http://codemirror.net/lib/codemirror.js'></script>

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
<!--http://localhost/cms/wordpress/bryan-pdf/-->
		<script language="javascript">
			document.getElementById("emergency-event").style.display = "block";
			document.getElementById("psi").style.display = "block";
			document.getElementById("dengue").style.display = "block";
			document.getElementById("genPsi").style.display = "none";
			document.getElementById("genDengue").style.display = "none";
		</script>
	<?php	
	}
?>
<style>
table {
	margin: 5px auto;
}
iframe {
	margin: 5px auto;
	display:block;}
td{
	padding: 2px 10px;
}
h3{
	text-align: center;
}

</style>


<body id="parent">
<p style="text-align: center; margin-top: 50px"><img class="alignnone wp-image-25" src="http://localhost/cms/wordpress/wp-content/uploads/2018/10/nea-logo-full-colour-300x120.jpg" alt="" width="500" height="200" /></p>
<h1 align="center"><b>Report</b></h1>
<h2 align="center">
<?php  
echo date("Y-m-d h:i");
?>

</h2>
<br>
<tcpdf method="AddPage" />
<h3 align="center">Dengue cases by location</h3>
<table border="1" width="650" cellpadding="10">
<col width="70%">
<col width="30%">
	<tr>
		<td bgcolor="#75aeff" align="center"><b>Area</b></td>
		<td bgcolor="#75aeff" align="center"><b>No. of cases</b></td>
	</tr>
<?php
$file = file_get_contents('assets\dengue-clusters-kml.kml', true);
$regex1 = "/SimpleData name=\"LOCALITY\">(.*)<\/SimpleData/";
$regex2 = "/SimpleData name=\"CASE_SIZE\">(.*)<\/SimpleData/";
preg_match_all ($regex1, $file, $matches1);
preg_match_all ($regex2, $file, $matches2);
for($i = 0;$i<count($matches1[0]);$i++){
	echo "<tr>";
    echo "<td>".$matches1[1][$i]."</td>";
    echo "<td align=\"center\">".$matches2[1][$i]."</td>";
    echo "</tr>";
}
?>
</table>
<br>
<h3 align="center">Dengue clusters on map</h3>
<center>
<a align="center" href="https://data.gov.sg/dataset/dengue-clusters/resource/ce15cf3c-702c-4573-96db-69c50e6cb7f8/view/7bb2a106-0e86-4f18-873b-726bb5b6f922">Dengue clusters</a>
</center>
<div id="preview-dengue">
<iframe id="dengue-container" width="800px" height="400px" src="https://data.gov.sg/dataset/dengue-clusters/resource/ce15cf3c-702c-4573-96db-69c50e6cb7f8/view/7bb2a106-0e86-4f18-873b-726bb5b6f922" frameBorder="1" align="center" ></iframe>
</div>


<br>
<tcpdf method="AddPage" />
<h3 align="center">New events</h3>
<table id="test" border="1" width="650" cellpadding="10">
<!--
<col width="15%">
<col width="15%">
<col width="10%">
<col width="10%">
<col width="50%">
-->
	<tr>
		<td bgcolor="#75aeff" align="center"><b>Title</b></td>
		<td bgcolor="#75aeff" align="center"><b>Date</b></td>
		<td bgcolor="#75aeff" align="center"><b>Status</b></td>
		<td bgcolor="#75aeff" align="center"><b>Type</b></td>
		<td bgcolor="#75aeff" align="center"><b>Detail</b></td>
		<td bgcolor="#75aeff" align="center"><b>Update count</b></td>
		<td bgcolor="#75aeff" align="center"><b>Task count</b></td>
		
	</tr>
<?php
$conn = mysqli_connect("localhost", "root", "", "cms");
//$ActiveSQL = "SELECT * FROM cms_event WHERE DATEDIFF(CURDATE(),date_time)>0 AND status='Active';" ;
$ActiveSQL = "SELECT * FROM cms_event E
LEFT JOIN 
(SELECT update_event_id, count(*) AS 'update count' from cms_update group by update_event_id) AS U on E.event_id = U.update_event_id
LEFT JOIN
(SELECT event_id, count(*) AS 'task count' FROM cms_task group by event_id) AS T on E.event_id = T.event_id
WHERE DATEDIFF(CURDATE(),E.date_time)>0 AND status='Active';";

//$TodaySQL = "SELECT * FROM cms_event WHERE DATEDIFF(CURDATE(),date_time)=0;" ;
$TodaySQL = "SELECT * FROM cms_event E
LEFT JOIN 
(SELECT update_event_id, count(*) AS 'update count' from cms_update group by update_event_id) AS U on E.event_id = U.update_event_id
LEFT JOIN
(SELECT event_id, count(*) AS 'task count' FROM cms_task group by event_id) AS T on E.event_id = T.event_id
WHERE DATEDIFF(CURDATE(),E.date_time)=0;" ;
if($result = mysqli_query($conn , $TodaySQL)){
	while($row = mysqli_fetch_row($result)){
		echo "<tr>";
		echo "<td>".$row[1]."</td>";
		echo "<td>".substr($row[2],0,10)."</td>";
		echo "<td>".$row[3]."</td>";
		echo "<td>".$row[4]."</td>";
		echo "<td>".$row[5]."</td>";
		if(is_null($row[15])){
			echo "<td>"."0"."</td>";
		}else{
			echo "<td>".$row[15]."</td>";
		}
		if(is_null($row[17])){
			echo "<td>"."0"."</td>";
		}else{
			echo "<td>".$row[17]."</td>";
		}
		echo "</tr>";
	}
	
}
?>
</table>
<?php
$count = mysqli_num_rows($result);
if($count==0){
	echo "<p align=\"center\">No new events</p>";
}
mysqli_free_result($result);
?>
<br>
<tcpdf method="AddPage" />
<h3 align="center">Active events</h3>
<table border="1" width="650" cellpadding="10">
<!-- <col width="15%">
<col width="15%">
<col width="10%">
<col width="10%">
<col width="50%"> -->
	<tr>
		<td bgcolor="#75aeff" align="center"><b>Title</b></td>
		<td bgcolor="#75aeff" align="center"><b>Date</b></td>
		<td bgcolor="#75aeff" align="center"><b>Status</b></td>
		<td bgcolor="#75aeff" align="center"><b>Type</b></td>
		<td bgcolor="#75aeff" align="center"><b>Detail</b></td>
		<td bgcolor="#75aeff" align="center"><b>Update Count</b></td>
		<td bgcolor="#75aeff" align="center"><b>Task count</b></td>
		
	</tr>
<?php
if($result = mysqli_query($conn , $ActiveSQL)){
	while($row = mysqli_fetch_row($result)){
		echo "<tr>";
		echo "<td>".$row[1]."</td>";
		echo "<td>".substr($row[2],0,10)."</td>";
		echo "<td>".$row[3]."</td>";
		echo "<td>".$row[4]."</td>";
		echo "<td>".$row[5]."</td>";
		if(is_null($row[15])){
			echo "<td>"."0"."</td>";
		}else{
			echo "<td>".$row[15]."</td>";
		}
		if(is_null($row[17])){
			echo "<td>"."0"."</td>";
		}else{
			echo "<td>".$row[17]."</td>";
		}
		echo "</tr>";
	}
}

?>
</table>
<?php
$count = mysqli_num_rows($result);
if($count==0){
	echo "<p align=\"center\">No active events</p>";
}
mysqli_free_result($result);
?>
<br>
<tcpdf method="AddPage" />
<h3 align="center">Case summary</h3>
<table border="1" width="650" cellpadding="10">
<!-- <col width="15%">
<col width="15%">
<col width="10%">
<col width="10%">
<col width="50%"> -->
	<tr>
		<td bgcolor="#75aeff" align="center"><b>Case type</b></td>
		<td bgcolor="#75aeff" align="center"><b>Number of cases</b></td>	
	</tr>

<?php
$CaseSQL="SELECT type_of_case, SUM(num_of_cases) FROM `cms_case` GROUP BY type_of_case";

if($result = mysqli_query($conn , $CaseSQL)){
	while($row = mysqli_fetch_row($result)){
		echo "<tr>";
		echo "<td>".$row[0]."</td>";
		echo "<td>".$row[1]."</td>";
		echo "</tr>";
	}
}
?>
</table>
<?php
$count = mysqli_num_rows($result);
if($count==0){
	echo "<p align=\"center\">No active events</p>";
}
mysqli_free_result($result);
mysqli_close($conn);
?>
<!--SELECT * FROM cms_event WHERE DATEDIFF(CURDATE(),date_time)>0 AND status='Active'
-->
<!--SELECT * FROM cms_event WHERE DATEDIFF(CURDATE(),date_time)=0
-->
</body>

<?php include 'footer-dashboard.php';?>

