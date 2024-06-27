
<?php
include 'connection.php';
$status = $_REQUEST["status"];
if ($status == 'readAll') {
    $query = "SELECT * FROM tblUser where userType='tr'";
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
    $userId = $_REQUEST["userId"];
    $query = "SELECT * FROM tblUser WHERE userId = $userId";
    $result = sqlsrv_query($conn, $query);
    $course = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    echo json_encode($course);
    sqlsrv_close($conn);
    return;
}

if ($status == 'readpass') {
    $userName = $_REQUEST["userName"];
    $query = "SELECT * FROM tblUser WHERE userName=$userName";
    $result = sqlsrv_query($conn, $query);
    $course = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    echo json_encode($course);
    sqlsrv_close($conn);
    return;
}
?>
