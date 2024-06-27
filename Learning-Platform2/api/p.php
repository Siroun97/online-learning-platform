<?php
// Establish your database connection here
require_once('connection.php');
// Fetch most viewed courses
$query_most_viewed = "SELECT TOP 3 courseName, numOfViews FROM course ORDER BY numOfViews DESC";
$result_most_viewed = sqlsrv_query($conn, $query_most_viewed);
$courses_most_viewed = [];
while ($row = sqlsrv_fetch_array($result_most_viewed, SQLSRV_FETCH_ASSOC)) {
    $courses_most_viewed[] = $row;
}

// Fetch most recent courses
$query_most_recent = "SELECT TOP 3 * FROM course ORDER BY startDate DESC";
$result_most_recent = sqlsrv_query($conn, $query_most_recent);
$courses_most_recent = [];
while ($row = sqlsrv_fetch_array($result_most_recent, SQLSRV_FETCH_ASSOC)) {
    $courses_most_recent[] = $row;
}

// Fetch random courses
$query_random = "SELECT TOP 3 * FROM course ORDER BY NEWID()";
$result_random = sqlsrv_query($conn, $query_random);
$courses_random = [];
while ($row = sqlsrv_fetch_array($result_random, SQLSRV_FETCH_ASSOC)) {
    $courses_random[] = $row;
}

// Close the connection
sqlsrv_close($conn);

// Combine the results into a structured format with status
$response = [
    "mostViewed" => [
        "status" => "mostViewed",
        "courses" => $courses_most_viewed
    ],
    "mostRecent" => [
        "status" => "mostRecent",
        "courses" => $courses_most_recent
    ],
    "randomCourses" => [
        "status" => "randomCourses",
        "courses" => $courses_random
    ]
];

// Return the response as JSON
echo json_encode($response);
?>
