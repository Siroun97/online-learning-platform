<?php
session_start();

include 'connection.php'; // Ensure 'connection.php' contains your database connection setup

// Retrieve and sanitize input data
$firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
$lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$userType = $_POST['userType']; // Assuming it's a safe value (e.g., selected from a predefined list)
$userName = filter_var($_POST['userName'], FILTER_SANITIZE_STRING);
$password = $_POST['password']; // Password is stored in plain text

// Check if email already exists
$query_check = "SELECT COUNT(*) AS count FROM tblUser WHERE email = ?";
$params_check = array($email);

$result_check = sqlsrv_query($conn, $query_check, $params_check);
if ($result_check === false) {
    // Handle query execution error
    echo json_encode(array('error' => 'Query execution failed: ' . print_r(sqlsrv_errors(), true)));
    exit;
}

$row = sqlsrv_fetch_array($result_check, SQLSRV_FETCH_ASSOC);
$count = $row['count'];

if ($count > 0) {
    // Email already exists
    header("location: ../signup.html");
} else {
    // Insert a new record with plain text password
    $query_insert = "INSERT INTO tblUser (firstName, lastName, email, userType, userName, password) VALUES (?, ?, ?, ?, ?, ?)";
    $params_insert = array($firstName, $lastName, $email, $userType, $userName, $password);

    $result_insert = sqlsrv_query($conn, $query_insert, $params_insert);
    if ($result_insert === false) {
        // Handle insert query execution error
        header("location: ../signup.html");
    } else {
        // Successful insertion
        header("Location: ../login.html");
    }
}

// Close the database connection
sqlsrv_close($conn);
?>
