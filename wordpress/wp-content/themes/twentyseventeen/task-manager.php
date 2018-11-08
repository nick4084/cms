<?php 
//error_reporting(E_ALL);
require_once "dbConfig.php";
if(isset($_POST['function'])){
    call_user_func($_POST['function']);
    die();
}

function insertTask(){
    $Action_scope= $_POST['new-action-scope'];
    $Status=  $_POST['new-status'];
    $Event_id= $_POST['new-task-id'];
    $Assigned_user=  $_POST['new-assigned-user'];
    
    $conn = getConnecion();
    $sql_insert_emergency_event_prepare = "INSERT INTO cms_task (`action_scope`,`status`,`event_id`,`assigned_user`) VALUES (?,?,?,?);";
    $statement = $conn->prepare($sql_insert_emergency_event_prepare);
    $statement->bind_param('ssss', $Action_scope, $Status, $Event_id, $Assigned_user);
    if ($statement->execute()) {
        //success
		var_dump($Action_scope);
        return true;
		
    } else {
        return $statement->error;
    }
    $conn->close();
}

function updateTask(){
    $Action_scope= $_POST['edit-action-scope'];
    $Status=  $_POST['edit-status'];
	$Task_id = $_POST['edit-task-id'];
    
    $conn = getConnecion();
    
    $sql_insert_emergency_event_prepare = "UPDATE cms_task SET action_scope=?, status=? Where task_id=?";
    $statement = $conn->prepare($sql_insert_emergency_event_prepare);
    $statement->bind_param('sss', $Action_scope, $Status, $Task_id);
    if ($statement->execute()) {
        //success
		var_dump($Action_scope);
        return true;
    } else {
		var_dump($Action_scope);
        return $statement->error;
    }
	
    $conn->close();
}
function getTask(){
	$Event_id=  $_POST['new-event-id'];
	
    $conn = getConnecion();
	$sql_insert_emergency_event_prepare = "SELECT * FROM `cms_task` WHERE event_id = ?";
    $statement = $conn->prepare($sql_insert_emergency_event_prepare);
    $statement->bind_param('ssssss', $Event_id);
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
}
function getTaskbyId($id){
    $conn = getConnecion();
	$sql_statement = "SELECT * FROM `cms_task` WHERE event_id = ".$id.";";
	$a=array();
    $query_result = mysqli_query($conn, $sql_statement);
    $array = $query_result->fetch_assoc();
	if($array["task_id"]!=null){
	array_push($a, (array($array["task_id"], $array["action_scope"], $array["status"], $array["event_id"],$array["assigned_user"],"")));
        if ($query_result->num_rows > 0) {
        // output data of each row
        while($row = $query_result->fetch_assoc()) {
            array_push($a, (array($row["task_id"], $row["action_scope"], $row["status"], $row["event_id"],$row["assigned_user"],"")));
        }
    }
    $conn->close();
}
	
	return array($a,$array);

}


function deleteTask(){
    
    $conn = getConnecion();
    $e_id = $_POST['edit-task-id'];
    $sql_statement = "DELETE FROM `cms_task` WHERE `task_id` = ".$e_id."";
    $query_result = mysqli_query($conn, $sql_statement);
    
    echo $e_id;
}


?>