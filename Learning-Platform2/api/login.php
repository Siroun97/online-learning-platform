<?php
session_start();

include 'connection.php';

if (isset($_POST['userName']) && isset($_POST['password'])) {
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tblUser WHERE userName = ? AND password = ?";
    $params = array(&$userName, &$password);
    $stmt = sqlsrv_prepare($conn, $query, $params);

    if ($stmt === false) {
        die(json_encode(array('status' => 'error', 'msg' => 'Error preparing SQL statement')));
    }

    if (sqlsrv_execute($stmt)) {
        $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if ($user) {
            $userType = $user['userType']; // Assuming 'userType' column exists

            // Check user type (te or tr) and store session data accordingly
            if (in_array($userType, array('te', 'tr'))) {
                $_SESSION['user'] = $user['userName'];
                $_SESSION['userId'] = $user['userId'];
                $_SESSION['userType'] = $userType; // Add userType to session

                // Redirect to appropriate page based on userType
                header("Location: ../course.html"); 
                exit();
            } else {
                // Invalid user type
                $errorMsg = 'Invalid user type';
            }
        } else {
            // Invalid credentials
            $errorMsg = 'Invalid credentials';
        }
    } else {
        // Error executing SQL statement
        die(json_encode(array('status' => 'error', 'msg' => 'Error executing SQL statement')));
    }
} else {
    // Handle case where username or password is not set
    $errorMsg = 'Please provide both username and password';
}

// If there's an error message, redirect back to login.html with error message
if (isset($errorMsg)) {
    $_SESSION['loginError'] = $errorMsg;
    header("Location: ../login.html");
    exit();
}
?>
