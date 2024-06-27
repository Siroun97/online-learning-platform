<?php
// Include the database connection file
include_once 'connection.php';

// Check if courseId is provided via GET or POST
if (isset($_REQUEST['courseId'])) {
    $courseId = $_REQUEST['courseId'];

    // Step 1: Fetch questions based on courseId
    $queryQuestions = "SELECT * FROM questions WHERE courseId = ?";
    $paramsQuestions = array($courseId);
    $stmtQuestions = sqlsrv_query($conn, $queryQuestions, $paramsQuestions);

    if ($stmtQuestions === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Array to store questions and their answers
    $questionsWithAnswers = array();

    // Step 2: Loop through each question and fetch its answers
    while ($question = sqlsrv_fetch_array($stmtQuestions, SQLSRV_FETCH_ASSOC)) {
        $questionId = $question['questionId'];
        $question['answers'] = array(); // Initialize answers array for the question

        // Fetch answers for the current questionId
        $queryAnswers = "SELECT * FROM answers WHERE questionId = ?";
        $paramsAnswers = array($questionId);
        $stmtAnswers = sqlsrv_query($conn, $queryAnswers, $paramsAnswers);

        if ($stmtAnswers === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Collect answers for the current question
        while ($answer = sqlsrv_fetch_array($stmtAnswers, SQLSRV_FETCH_ASSOC)) {
            $question['answers'][] = $answer;
        }

        // Add question with answers to the result array
        $questionsWithAnswers[] = $question;

        // Free the statement resources
        sqlsrv_free_stmt($stmtAnswers);
    }

    // Free the statement resources
    sqlsrv_free_stmt($stmtQuestions);

    // Return the array of questions with answers as JSON
    echo json_encode($questionsWithAnswers);
} else {
    // Error handling if courseId is not provided
    echo json_encode(array("error" => "CourseId not provided"));
}

// Close the database connection
sqlsrv_close($conn);
?>
