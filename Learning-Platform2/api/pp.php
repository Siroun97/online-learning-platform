<?php
// Establish your database connection here
require_once('connection.php');
// Fetch most viewed courses
$myportalnames= "SELECT * FROM portal";
$result_myportalnames = sqlsrv_query($conn, $myportalnames);
$courses_myportalnames = [];
while ($row = sqlsrv_fetch_array($result_myportalnames, SQLSRV_FETCH_ASSOC)) {
    $courses_myportalnames[] = $row;
}

// Fetch most recent courses
$query_mycourses = "SELECT * FROM course";
$result_mycourses = sqlsrv_query($conn, $query_mycourses);
$courses_mycourses = [];
while ($row = sqlsrv_fetch_array($result_mycourses, SQLSRV_FETCH_ASSOC)) {
    $courses_mycourses[] = $row;
}


// Close the connection
sqlsrv_close($conn);

// Combine the results into a structured format with status
$response = [
    "portalName" => [
        "status" => "myportalnames",
        "names" => $courses_myportalnames
    ],
    "courseName" => [
        "status" => "mycoursenames",
        "names" => $courses_mycourses
    ]
    
];

// Return the response as JSON
echo json_encode($response);
?>
