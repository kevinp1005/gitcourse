<?php


require_once 'include/DB_Functions.php';
include 'login.php';
$db = new DB_Functions();
$response = array("error" => FALSE);


if (isset($_POST['logout_loc']) && isset($_POST['logout_loc2'])) {
  
    // receiving the post params

    $latitude =  $_POST['logout_loc'];
    $longitude = $_POST['logout_loc2'];
    $logout_loc = $latitude.",".$longitude;
    $db->logoutTracker($logout_loc);

} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}



?>
