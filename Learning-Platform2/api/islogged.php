<?php
session_start();

include 'connection.php';

// Check if user is logged in
if(isset($_SESSION['user'])) {
    // User is logged in
    $response = array(
        'status' => 'success',
        'user' => $_SESSION['user'],
        'userId' => $_SESSION['userId'],
        'userType'=>$_SESSION['userType']
         // Include userId in the response
    );
   
} else {
    // User is not logged in
    $response = array('status' => 'fail', 'msg' => 'User not logged in');
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
