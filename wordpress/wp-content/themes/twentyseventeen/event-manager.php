<?php 
error_reporting(E_ALL);
require "dbConfig.php";
if(isset($_POST['function'])){
    call_user_func($_POST['function']);
    return;
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
        $statement->execute();
    } else {
        return $statement->error;
    }
    $conn->close();
}
?>