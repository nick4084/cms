<?php 
error_reporting(E_ALL);
require "dbConfig.php";
if(isset($_POST['function'])){
    call_user_func($_POST['function']);
    return;
}

if (isset($_POST['submitBtn']))
	insertCase();

function retrieveCase(){
	
	$data = "Pass from PHP";
	//echo "RETRIEVE CASE IN";
	
	$conn = getConnecion();
	$sql_retrieve_all_cases = "SELECT name, type_of_case, postal_code, num_of_cases, contact, remarks,datetime FROM cms_case";
	$result = $conn->query($sql_retrieve_all_cases);

	if ($result->num_rows > 0) {
		// output data of each row
		$count = 0;
		while($row = $result->fetch_assoc()) {
			//Store each row in a array (storing array in an array)
			$list[$count] = array($row["name"], $row["type_of_case"], $row["postal_code"], $row["num_of_cases"], $row["contact"], $row["remarks"], $row["datetime"]);
			$count++;
		}
		//Allow the javascript to access this list
		echo json_encode($list);
	} 
	else 
	{
		echo "0 results";
	}
	$conn->close();
	
}

function insertCase(){
	
	if (isset($_POST['ddl_typeOfCase']))
		$typeOfCase = $_POST['ddl_typeOfCase'];
	if (isset($_POST['tb_name']))
		$name = $_POST['tb_name'];
	if (isset($_POST['tb_postalCode']))
		$postalCode = $_POST['tb_postalCode'];
	if (isset($_POST['tb_numOfCase']))
		$numOfCase = $_POST['tb_numOfCase'];
	if (isset($_POST['tb_contact']))
		$contact = $_POST['tb_contact'];
	if (isset($_POST['ta_remarks']))
		$remarks = $_POST['ta_remarks'];
	 
	date_default_timezone_set('Asia/Singapore');
	$datetime = date("Y-m-d H:i:s");
	
	if(!empty($typeOfCase) && !empty($name) && !empty($postalCode) && !empty($contact) &&!empty($remarks))
	{
		$conn = getConnecion();
		$sql_insert_case = "INSERT INTO cms_case (name, type_of_case, postal_code, num_of_cases, contact, remarks, datetime) VALUES (?,?,?,?,?,?,?);";
		$statement = $conn->prepare($sql_insert_case);
		$statement->bind_param('sssisss', $name, $typeOfCase, $postalCode, $numOfCase, $contact, $remarks, $datetime);
		$statement->execute();
		/*if ($statement->execute()) {
			echo "TEST";
			$statement->execute();
		} else {
			return $statement->error;
		}*/
		$conn->close();
	}
}
?>