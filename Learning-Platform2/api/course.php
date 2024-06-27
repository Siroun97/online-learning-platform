<?php
include 'connection.php';

$status = $_REQUEST["status"];

if ($status == 'readAll') {
    $query = "SELECT * FROM course";
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
    $courseId = $_REQUEST["courseId"];
    $query = "SELECT * FROM course WHERE CourseId = $courseId";
    $result = sqlsrv_query($conn, $query);
    $course = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    echo json_encode($course);
    sqlsrv_close($conn);
    return;
}

if ($status == 'coursesByTrainer') {
    $userId = $_REQUEST["userId"];
    $query = "SELECT * FROM course WHERE trainerId = $userId";
    $result = sqlsrv_query($conn, $query);
    
    $courses = [];
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $courses[] = $row;
    }
    
    echo json_encode($courses);
    sqlsrv_close($conn);
    return;
}


if ($status == 'deleteOne') {
    $courseId = $_REQUEST["courseId"];
    $query = "DELETE FROM course WHERE CourseId = $courseId";
    $result = sqlsrv_query($conn, $query);
    // Check for errors and handle them appropriately
    sqlsrv_close($conn);
    return;
}

if ($status == 'updateOne') {
    $courseId = $_REQUEST["courseId"];
    $query = "UPDATE course SET CourseName = 'ajastatus' WHERE CourseId = $courseId";
    $result = sqlsrv_query($conn, $query);
    // Check for errors and handle them appropriately
    sqlsrv_close($conn);
    return;
}

if ($status == "new") {
    $CourseName = $_REQUEST["CourseName"];
    $query = "INSERT INTO course (CourseName) VALUES ('$CourseName'); SELECT SCOPE_IDENTITY() AS CourseId";
    $result = sqlsrv_query($conn, $query);
    $courseId = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)['CourseId'];
    $arr['CourseId'] = $courseId;
    echo json_encode($arr);
    sqlsrv_close($conn);
    return;
}

if ($status == 'mostViewed') {
    $query = "SELECT TOP 3 courseName, numOfViews FROM course ORDER BY numOfViews DESC";
    $result = sqlsrv_query($conn, $query);
    $courses = [];
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        // Include courseName and numOfViews in the response
        $courses[] = $row;
    }
    echo json_encode($courses);
    sqlsrv_close($conn);
    return;
}


if ($status == 'mostRecent') {
    $query = "SELECT TOP 3 * FROM course ORDER BY startDate DESC";
    $result = sqlsrv_query($conn, $query);
    $courses = [];
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $courses[] = $row;
    }
    echo json_encode($courses);
    sqlsrv_close($conn);
    return;
}

if ($status == 'randomCourses') {
    $query = "SELECT TOP 3 * FROM course ORDER BY NEWID()";
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
