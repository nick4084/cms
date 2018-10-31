<?php 
error_reporting(E_ALL);
require "dbConfig.php";
if(isset($_POST['function'])){
    call_user_func($_POST['function']);
    return;
}

function CreateUpdate(){
   
    $Date= $_POST['new-update-date'];
    $Comments=  $_POST['new-update-comments'];
	$ID = $_POST['new-update-ID'];
	
	$Date = date('Y-m-d H:i:s', strtotime($Date));
	$User = "Officer";
	
    $conn = getConnecion();
    $sql_update_event_prepare = "INSERT INTO cms_update (date_time, post_comment, update_user, update_event_id) VALUES (?,?,?,?);";
	
    $statement = $conn->prepare($sql_update_event_prepare);
    $statement->bind_param('sssi', $Date, $Comments, $User, $ID);

    if ($statement->execute()) {
        $statement->execute();
    } else {
        return $statement->error;
    }
    $conn->close();
}
?>