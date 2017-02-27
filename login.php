<?php session_start();?>
<?

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// $_SESSION['GXTrackerID'] = $_POST['GXTrackerID'];
// json response array
$response = array("error" => FALSE);

if (isset($_POST['GXTrackerID']) && isset($_POST['password'])) {

    // receiving the post params
    $GXTrackerID = $_POST['GXTrackerID'];
    $password = $_POST['password'];
    $login_loc = $_POST['login_loc'].",".$_POST['login_loc2'];
    // get the user by email and password
    $user = $db->getUserByEmailAndPassword($GXTrackerID, $password);


    if ($user != false) {
        // use is found
        $db->inputTracker($GXTrackerID, $login_loc);
        $response["error"] = FALSE;
        $response["id"] = $user ["id"];
        $response["uid"] = $user["unique_id"];
        $response["user"]["GXTrackerID"] = $user["GXTrackerID"];
        $response["user"]["NamaLengkap"] = $user["NamaLengkap"];
        $response["user"]["email"] = $user["email"];
        $response["user"]["created_at"] = $user["created_at"];
        $response["user"]["updated_at"] = $user["updated_at"];
        echo json_encode($response);

    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}
?>
