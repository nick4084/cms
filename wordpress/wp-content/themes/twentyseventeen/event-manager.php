<?php 
error_reporting(E_ALL);
require "dbConfig.php";
if(isset($_POST['function'])){
    call_user_func($_POST['function']);
    die();
}

function insertEvent(){
    $Title = $_POST['new-event-title'];
    $Date= $_POST['new-event-date'];
    $Type=  $_POST['new-event-type'];
    $Status=  $_POST['new-event-status'];
    $Details=  $_POST['new-event-details'];
    $Creator= "";
    
    $conn = getConnecion();
    $sql_insert_emergency_event_prepare = "INSERT INTO cms_event (title, date_time, status, type, details, created_by) VALUES (?,?,?,?,?,?);";
    $statement = $conn->prepare($sql_insert_emergency_event_prepare);
    $statement->bind_param('ssssss', $Title, $Date, $Status, $Type, $Details, $creator);
    if ($statement->execute()) {
        //success
        return true;
    } else {
        return $statement->error;
    }
    $conn->close();
}
function getEvents(){
  
    $conn = getConnecion();
    $sql_statement = "SELECT event_id, title, date_time, status, details, type, created_by, (SELECT COUNT(*) FROM cms.cms_update WHERE cms_update.update_event_id = cms_event.event_id) AS Updates, (SELECT COUNT(*) FROM cms.cms_task WHERE cms_task.event_id = cms_event.event_id) AS Tasks FROM cms.cms_event WHERE type=\"Dengue\";";
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
}
?>