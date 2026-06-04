<?php

require_once "db.php";

/** @var PDO $pdo */

date_default_timezone_set("Europe/Amsterdam");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: game.php");
    exit();
}

$username = trim($_POST["username"] ?? "");
$timeSeconds = $_POST["time_seconds"] ?? null;
$accuracy = $_POST["accuracy"] ?? null;
$mistakes = $_POST["mistakes"] ?? null;

if ($username === "") {
    $username = "Anonymous";
}

$username = substr($username, 0, 50);

if ($timeSeconds === null || $accuracy === null || $mistakes === null) {
    die("Missing score data.");
}

$createdAt = date("Y-m-d H:i:s");

$stmt = $pdo->prepare("
    INSERT INTO scores (username, time_seconds, accuracy, mistakes, created_at)
    VALUES (:username, :time_seconds, :accuracy, :mistakes, :created_at)
");

$stmt->execute([
    ":username" => $username,
    ":time_seconds" => $timeSeconds,
    ":accuracy" => $accuracy,
    ":mistakes" => $mistakes,
    ":created_at" => $createdAt
]);

header("Location: leaderboard.php");
exit();