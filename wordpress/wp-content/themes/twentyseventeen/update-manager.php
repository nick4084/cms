<?php 
//error_reporting(E_ALL);
require_once('dbConfig.php');
if(isset($_POST['function'])){
    call_user_func($_POST['function']);
    die();
}

if(isset($_POST['delete-update-id']))
{
    $conn = getConnecion();
    $delete_event_id = $_POST['delete-update-id'];
    $sql_statement = "DELETE FROM cms_update WHERE update_id = ".$delete_event_id.";";
    $query_result = mysqli_query($conn, $sql_statement);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
    
}

function CreateUpdate(){
   
    $Date= $_POST['new-update-date'];
    $Comments=  $_POST['new-update-comments'];
    $ID = $_POST['new-update-id'];
    $User = $_POST['new-update-user'];
	
	
	
    $conn = getConnecion();
    $sql_create = "INSERT INTO cms_update (date_time, post_comment, update_user, update_event_id) VALUES (?,?,?,?);";
	
    $statement = $conn->prepare($sql_create);
    $statement->bind_param('sssi', $Date, $Comments, $User, $ID);
    $statement->execute();
    
    $statement->close();
    $conn->close();
}



function UpdateUpdate(){
    
	$Date= $_POST['new-update-date'];
    $Comments=  $_POST['new-update-comments'];
	$ID = $_POST['new-update-ID'];
	
    $conn = getConnecion();
    
    $sql_update= "UPDATE cms_update SET date_time = ?, post_comment = ?, update_user = ? Where update_event_id = ?;";
    $statement = $conn->prepare($sql_update);
    $statement->bind_param('sssi', $Date, $Comments, $User, $ID);
    if ($statement->execute()) {
        //success
        return true;
    } else {
        return $statement->error;
    }
    $conn->close();
}
/*function getUpdates(){
	
	
    $conn = getConnecion();
    $sql_statement = "SELECT * from CMS_update";
    $query_result = mysqli_query($conn, $sql_statement);
    $array = mysqli_fetch_assoc($query_result);
    $a=array();
    if ($query_result->num_rows > 0) {
        // output data of each row
        while($row = $query_result->fetch_assoc()) {
            array_push($a, (array($row["event_id"], $row["title"], $row["date_time"], $row["details"], $row["Updates"], $row["Tasks"], $row["type"], $row["status"], "")));
        }
    }
    $conn->close();
    $obj = new stdClass();
    $obj->success = true;
    $obj->response = 200;
    $obj->dataset = $a;
    
    echo json_encode($obj);
}*/

function getUpdatebyId($id){
    $conn = getConnecion();
    $sql_statement = "SELECT * FROM cms_update WHERE update_event_id=".$id." ORDER BY update_id;";
    $query_result = mysqli_query($conn, $sql_statement);
    $array = mysqli_fetch_assoc($query_result);
	$a=array();
		array_push($a, (array($array["update_id"], $array["date_time"], $array["post_comment"], $array["update_user"],"")));
	if ($query_result->num_rows > 0) {
        // output data of each row
        while($row = $query_result->fetch_assoc()) {
            array_push($a, (array($row["update_id"],$row["date_time"],$row["post_comment"],$row["update_user"],"")));
        }
    }
	$conn->close();
    return $a;
}


?>

