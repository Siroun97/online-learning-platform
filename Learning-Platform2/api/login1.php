<?php
include 'connection.php';
$status = $_REQUEST["status"];

if ($status == 'readAll') {
    $query = "SELECT userName,password FROM tblUser where userType='te'";
    $result = sqlsrv_query($conn, $query);
    $courses = [];
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $courses[] = $row;
    }
    echo json_encode($courses);
    sqlsrv_close($conn);
    return;
}

if ($status == 'readOne') {
    $lessonId = $_REQUEST["lessonId"];
    $query = "SELECT * FROM lesson WHERE lessonId=$lessonId";
    $result = sqlsrv_query($conn, $query);
    $course = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    echo json_encode($course);
    sqlsrv_close($conn);
    return;
}



?>