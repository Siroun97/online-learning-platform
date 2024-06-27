<?php
session_start();

include 'connection.php';

$userName = $_POST['userName'];
$password = $_POST['password'];

$query = "SELECT * FROM tblUser WHERE userName = ? AND password = ?";
$stmt = sqlsrv_prepare($conn, $query, array(&$userName, &$password));

if ($stmt === false) {
  die(json_encode(array('status' => 'error', 'msg' => 'Error preparing SQL statement')));
}

if (sqlsrv_execute($stmt)) {
  $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

  if ($user) {
    $userType = $user['userType']; // Assuming 'usertype' column exists

    // Check user type (te or tr) and store session data accordingly
    if (in_array($userType, array('te', 'tr'))) {
      $_SESSION['user'] = $user['userName'];
      $_SESSION['userId'] = $user['userId'];
      $_SESSION['userType'] = $userType; // Add userType to session

      // Prepare the response including username and userType
      $response = array('status' => 'success', 'userName' => $user['userName'], 'userType' => $userType);

      echo json_encode($response);

      // Redirect to appropriate page based on userType (optional)
      
        header("Location: ../teachers.html"); // Redirect for trainers
      
      exit();
    } else {
      $response = array('status' => 'fail', 'msg' => 'Invalid user type');
    }
  } else {
    $response = array('status' => 'fail', 'msg' => 'Invalid credentials');
  }

  // Only echo the JSON encoded response if not redirected
  echo json_encode($response);
} else {
  die(json_encode(array('status' => 'error', 'msg' => 'Error executing SQL statement')));
}
?>
