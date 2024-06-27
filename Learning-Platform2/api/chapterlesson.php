<?php

// Establish your database connection here
require_once('connection.php');
$courseId = $_REQUEST["courseId"];

// Fetch chapters along with their lessons
$chapters_query = "SELECT chapter.*, lesson.* FROM chapter LEFT JOIN lesson ON chapter.chapterId = lesson.chapterId WHERE chapter.courseId = $courseId";
$result = sqlsrv_query($conn, $chapters_query);

// Define an array to store chapters and their lessons
$chapters = [];

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $chapterId = $row['chapterId'];
    $lessonId = $row['lessonId'];

    // If the chapter doesn't exist in the $chapters array yet, add it
    if (!isset($chapters[$chapterId])) {
        $chapters[$chapterId] = [
            'chapterId' => $row['chapterId'],
            'chapterName' => $row['chapterName'],
            'lessons' => []
        ];
    }

    // Handle NULL or undefined 'duration'
    $duration = isset($row['duration']) ? $row['duration'] : "N/A";

    // Add the lesson to the respective chapter
    $chapters[$chapterId]['lessons'][] = [
        'lessonId' => $lessonId,
        'lessonName' => $row['lessonName'],
        'duration' => $duration
    ];
}

// Close the connection
sqlsrv_close($conn);

// Return the chapters array as JSON
echo json_encode($chapters);
?>
