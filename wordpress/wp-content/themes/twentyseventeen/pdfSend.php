
<?php /* Template Name: pdfSend*/ ?>
<?php include 'header-dashboard.php';?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>
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
</style>
<?php 
	$html = file_get_contents('http://localhost/cms/wordpress/viewpdf/');
	$txt = $html;
?>
<?php
require_once('tcpdf/tcpdf.php');
 
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('NEA');
$pdf->SetTitle('Report');
$pdf->SetSubject('Report');
 
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);
 
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
 
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 

 // set font

// add a page
//$pdf->AddPage();
$htmls = explode("<tcpdf method=\"AddPage\" />",$html);
foreach($htmls as $page){
	$pdf->AddPage();
	$pdf->writeHTML($page, true, false, true, false, '');
}

// print a block of text using Write()
//$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
ob_end_clean();
$date=date("Ymdhi");
$filepath = __DIR__.'/report'.$date.'.pdf';
$pdf->Output($filepath, 'I');

?>

<?php
require "PHPMailer\PHPMailer.php";
require "PHPMailer\SMTP.php";
require "PHPMailer\Exception.php";
if(false)
{
$email = "ssad.cz3006@gmail.com";
$password = "cz3006_ssad";
$to_id = "bryan.lyy123@gmail.com";
$message = "testing";
$subject = "The fkin report";
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = $email;
$mail->Password = $password;
$mail->setFrom("ssad.cz3006@gmail.com",'SSAD Test');
$mail->addAttachment($filepath); 
$mail->addAddress($to_id);
$mail->Subject = $subject;
$mail->msgHTML($message);
/*if (!$mail->send()) {
$error = "Mailer Error: " . $mail->ErrorInfo;
echo '<p id="para">'.$error.'</p>';
}
else {
echo '<p id="para">Message sent!</p>';
}*/
}
else{
echo '<p id="para">Please enter valid data</p>';
}
?>
</body>

<?php include 'footer-dashboard.php';?>

