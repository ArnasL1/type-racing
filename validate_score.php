<?php

require_once "db.php";
date_default_timezone_set("Europe/Amsterdam");



$startTime = $_POST['startTime'] ?? -1;
$endTime = $_POST['endTime'] ?? -1;
$mistakes = $_POST['mistakes'] ?? -1;
$sentenceId = $_POST['sentenceId'] ?? -1;

if ($startTime < 0 || $endTime < 0 || $mistakes < 0 || $sentenceId < 0) {
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
$wordCount = str_word_count($pdo->query("SELECT text FROM sentences WHERE id = $sentenceId")->fetchColumn());
$wpm = ($wordCount / ($timeTaken / 1000)) * 60;

if ($wpm > 304.76) {
    http_response_code(400);
    echo json_encode(['error' => 'WPM higher than world record']);
    exit;
}

$username = "Anonymous";
$createdAt = date("Y-m-d H:i:s");

$stmt = $pdo->prepare("
    INSERT INTO scores (sentence_id, username, time_taken, mistakes, created_at)
    VALUES (:sentence_id, :username, :time_taken, :mistakes, :created_at)
");

$stmt->execute([
    ":sentence_id" => $sentenceId,
    ":username" => $username,
    ":time_taken" => $timeTaken,
    ":mistakes" => $mistakes,
    ":created_at" => $createdAt
]);

header('Location: leaderboard.php');
