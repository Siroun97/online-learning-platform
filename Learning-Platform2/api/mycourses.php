<?php
include 'connection.php'; // Ensure this file connects to your database

// Function to sanitize and validate array of integers
function sanitizeCourseIds($ids) {
  return array_map('intval', $ids); // Convert each element to integer
}

if (isset($_GET["courseIds"])) {
  $courseIds = $_GET["courseIds"]; // Get courseIds array from request

  if (!is_array($courseIds)) {
    die(json_encode(array())); // Return empty array if courseIds is not an array
  }

  // Validate and sanitize input
  $sanitizedCourseIds = sanitizeCourseIds($courseIds);

  // Prepare placeholders for the IN clause
  $placeholders = implode(',', array_fill(0, count($sanitizedCourseIds), '?'));

  $query = "SELECT * FROM course WHERE courseId IN ($placeholders)";
  $params = $sanitizedCourseIds; // Parameters for prepared statement

  $stmt = sqlsrv_prepare($conn, $query, $params);

  if ($stmt === false) {
    die(json_encode(array())); // Return empty array on error
  }

  if (sqlsrv_execute($stmt)) {
    $courses = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
      $courses[] = $row; // Add each course information to the array
    }
    header('Content-Type: application/json');
    echo json_encode($courses);
  } else {
    die(json_encode(array())); // Return empty array on error
  }

  sqlsrv_close($conn);
  return;
} else {
  die(json_encode(array())); // Return empty array if courseIds parameter is missing
}
?>
