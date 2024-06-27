<?php
include 'connection.php'; // Ensure this file connects to your database

// Assuming $traineeId and $courseId are the parameters you want to check
if (!isset($_GET['traineeId']) || !isset($_GET['courseId'])) {
  die(json_encode(array('status' => 'error', 'msg' => 'TraineeId or courseId parameter is missing')));
}

$traineeId = $_GET['traineeId'];
$courseId = $_GET['courseId'];

// Prepare a single SQL statement using JOIN
$query = "SELECT 1 FROM participation p
          JOIN participatedcourse pc ON p.participationId = pc.participationId
          WHERE p.traineeId = ? AND pc.courseId = ?";
$params = array(&$traineeId, &$courseId);
$stmt = sqlsrv_prepare($conn, $query, $params);

if ($stmt === false) {
  die(json_encode(array('status' => 'error', 'msg' => 'Error preparing SQL statement')));
}

// Execute the statement
if (sqlsrv_execute($stmt)) {
  // Check if a row exists (participation and course match)
  if (sqlsrv_has_rows($stmt)) {
    $response = array('status' => 'success', 'msg' => 'Trainee has participated in the course');
  } else {
    $response = array('status' => 'fail', 'msg' => 'Trainee has not participated in the course');
  }
  // Send JSON response
  header('Content-Type: application/json');
  echo json_encode($response);
} else {
  // Error executing the statement
  die(json_encode(array('status' => 'error', 'msg' => 'Error executing SQL statement')));
}

sqlsrv_close($conn); // Close connection (optional, recommended)
