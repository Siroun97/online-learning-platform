<?php
include 'connection.php'; // Ensure this file connects to your database

if (isset($_GET["userId"])) {
    $userId = $_GET["userId"];
    
    // Query to fetch participationId from participation table for a given userId
    $query = "SELECT participationId FROM participation WHERE traineeId = ?";
    $params = array($userId);
    $stmt = sqlsrv_prepare($conn, $query, $params);
    
    if ($stmt === false) {
        die(json_encode(array())); // Return an empty array on error
    }
    
    // Execute the SQL statement
    if (sqlsrv_execute($stmt)) {
        $participationIds = array();
        
        // Fetch all participationIds into an array
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $participationIds[] = $row['participationId'];
        }
        
        // Now fetch courseIds from participatedcourse table for each participationId
        $courses = array();
        
        foreach ($participationIds as $participationId) {
            $query2 = "SELECT courseId FROM participatedcourse WHERE participationId = ?";
            $params2 = array($participationId);
            $stmt2 = sqlsrv_prepare($conn, $query2, $params2);
            
            if ($stmt2 === false) {
                continue; // Skip to next iteration on error
            }
            
            // Execute the second SQL statement
            if (sqlsrv_execute($stmt2)) {
                while ($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                    $courses[] = $row2['courseId'];
                }
            }
        }
        
        // Send JSON response with courses array directly
        header('Content-Type: application/json');
        echo json_encode($courses);
    } else {
        die(json_encode(array())); // Return an empty array on error
    }
    
    sqlsrv_close($conn);
    return;
} else {
    die(json_encode(array())); // Return an empty array if userId parameter is missing
}
?>
