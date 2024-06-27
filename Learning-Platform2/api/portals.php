<?php
include 'connection.php';


$status = $_REQUEST["status"];

if ($status == 'readAll') {
    $query = "SELECT * FROM portal";
    $result = sqlsrv_query($conn, $query);
    $courses = [];
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $courses[] = $row;
    }
    echo json_encode($courses);
    sqlsrv_close($conn);
    return;
}

if ($status == 'readAll2') {
    $query = "SELECT courseName,portalId FROM course";
    $result = sqlsrv_query($conn, $query);
    $courses = [];
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $courses[] = $row;
    }
    echo json_encode($courses);
    sqlsrv_close($conn);
    return;
}

?>


