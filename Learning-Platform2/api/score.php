<?php

include 'connection.php';

// Assuming you've sanitized and validated input parameters for security




    $score = $_REQUEST["score"];
    $userId = $_REQUEST["userId"];
    $courseId = $_REQUEST["courseId"];

    // Check if the combination of userId and courseId already exists
    $query_check = "SELECT COUNT(*) AS count FROM results WHERE userId = $userId AND courseId = $courseId";
    $result_check = sqlsrv_query($conn, $query_check);

    if ($result_check === false) {
        echo json_encode(array('error' => 'Query execution failed'));
        return;
    }

    $row = sqlsrv_fetch_array($result_check, SQLSRV_FETCH_ASSOC);
    $count = $row['count'];

    if ($count > 0) {
        // If record exists, update the score
        $query_update = "UPDATE results SET score = $score WHERE userId = $userId AND courseId = $courseId";
        $result_update = sqlsrv_query($conn, $query_update);

        if ($result_update === false) {
            echo json_encode(array('error' => 'Update query execution failed'));
            return;
        }

        echo json_encode(array('message' => 'Score updated successfully'));
    } else {
        // If record does not exist, insert a new record
        $query_insert = "INSERT INTO results (score, userId, courseId) VALUES ($score, $userId, $courseId)";
        $result_insert = sqlsrv_query($conn, $query_insert);

        if ($result_insert === false) {
            echo json_encode(array('error' => 'Insert query execution failed'));
            return;
        }

        echo json_encode(array('message' => 'New result inserted successfully'));
    }

?>