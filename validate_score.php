<?php

$startTime = $_POST['startTime'] ?? -1;
$endTime = $_POST['endTime'] ?? -1;
$mistakes = $_POST['mistakes'] ?? -1;
$sentence = $_POST['sentence'] ?? null;

if ($startTime < 0 || $endTime < 0 || $mistakes < 0 || !$sentence) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

if ($startTime >= $endTime) {
    http_response_code(400);
    echo json_encode(['error' => 'End time must be greater than start time']);
    exit;
}

$timeTaken = $endTime - $startTime;
$wordCount = str_word_count($sentence);
$wpm = ($wordCount / $timeTaken) * 60;

if ($wpm > 304.76) {
    http_response_code(400);
    echo json_encode(['error' => 'WPM higher than world record']);
    exit;
}

$conn = new mysqli('localhost','root','','type_racing');
if ($conn->connect_error) { die('DB error: ' . $conn->connect_error); }

$stmt = $conn->prepare(
    'INSERT INTO scores (sentence_id, username, time_taken, mistakes, created_at)
     VALUES (?, ?, ?, ?, NOW())'
);
$sentenceId = 1; // Replace with actual sentence ID
$username = 'test_user'; // Replace with actual username from session
$stmt->bind_param('sdii', $sentenceId, $username, $timeTaken, $mistakes);
$stmt->execute();

header('Location: leaderboard.php');