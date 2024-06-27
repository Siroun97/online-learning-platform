<?php
include 'connection.php';

$traineeId = $_REQUEST["traineeId"];
$courseId = $_REQUEST["courseId"];

// Insert the traineeId into the participation table
$queryInsert = "INSERT INTO participation (traineeId) VALUES ('$traineeId')";
$resultInsert = sqlsrv_query($conn, $queryInsert);
if ($resultInsert === false) {
    die(json_encode(array('status' => 'error', 'msg' => 'Error inserting data into participation table: ' . print_r(sqlsrv_errors(), true))));
}

// Retrieve the last identity value using SCOPE_IDENTITY()
$querySelect = "SELECT SCOPE_IDENTITY() AS participationId";
$resultSelect = sqlsrv_query($conn, $querySelect);
if ($resultSelect === false) {
    die(json_encode(array('status' => 'error', 'msg' => 'Error retrieving participation ID: ' . print_r(sqlsrv_errors(), true))));
}

// Fetch the participation ID
$row = sqlsrv_fetch_array($resultSelect, SQLSRV_FETCH_ASSOC);
$participationId = $row['participationId'];

// Insert the participationId and courseId into participatedcourse
$queryInsertParticipatedCourse = "INSERT INTO participatedcourse (participationId, courseId) VALUES (?, ?)";
$params = array($participationId, $courseId);
$stmtInsertParticipatedCourse = sqlsrv_query($conn, $queryInsertParticipatedCourse, $params);
if ($stmtInsertParticipatedCourse === false) {
    die(json_encode(array('status' => 'error', 'msg' => 'Error inserting data into participatedcourse table: ' . print_r(sqlsrv_errors(), true))));
}

// Prepare the response array
$arr['status'] = 'success';
$arr['participationId'] = $participationId;

// Return the JSON response
echo json_encode($arr);
?>


