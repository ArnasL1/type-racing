<?php

require_once "db.php";

/** @var PDO $pdo */

date_default_timezone_set("Europe/Amsterdam");

$todayStart = date("Y-m-d 00:00:00");
$todayEnd = date("Y-m-d 23:59:59");

$stmt = $pdo->prepare("
    SELECT s.*
    FROM scores s
    INNER JOIN (
        SELECT username, MAX(created_at) AS newest_score
        FROM scores
        WHERE created_at BETWEEN :today_start AND :today_end
        GROUP BY username
    ) latest
    ON s.username = latest.username
    AND s.created_at = latest.newest_score
    WHERE s.created_at BETWEEN :today_start AND :today_end
    ORDER BY s.mistakes DESC, s.time_taken ASC, s.mistakes ASC
");

$stmt->execute([
    ":today_start" => $todayStart,
    ":today_end" => $todayEnd
]);

$scores = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">

<nav class="mb-4 border border-slate-300 bg-white p-4 shadow-sm">
    <div class="relative flex items-center justify-center w-full">
        <h1 class="absolute left-4 text-3xl font-semibold text-slate-900">Type Racing</h1>

        <div class="flex items-center gap-4 text-md">
            <a href="home.php" class="hover:text-blue-600">Home</a>
            <a href="game.php" class="hover:text-blue-600">Play</a>
            <a href="leaderboard.php" class="hover:text-blue-600">Leaderboard</a>
        </div>
    </div>
</nav>

<main class="mx-auto max-w-5xl px-6 py-10">
    <section class="rounded border border-slate-300 bg-white p-8 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-4xl font-bold text-slate-900">Today's Leaderboard</h2>
                <p class="mt-2 text-slate-600">
                    Showing the most recent game per user for today.
                </p>
                <p class="text-sm text-slate-500">
                    Based on Europe/Amsterdam time.
                </p>
            </div>

            <a href="game.php"
               class="rounded bg-blue-600 px-5 py-3 font-semibold text-white shadow-sm hover:bg-blue-700">
                Play
            </a>
        </div>

        <?php if (count($scores) === 0): ?>

            <div class="rounded border border-slate-200 bg-slate-50 p-6 text-center text-slate-700">
                <p class="text-lg font-semibold">No scores yet today.</p>
                <p class="mt-2">Scores will appear here after a game is saved.</p>
            </div>

        <?php else: ?>

            <div class="overflow-hidden rounded border border-slate-200">
                <table class="w-full border-collapse bg-white text-left">
                    <thead class="bg-slate-50">
                    <tr>
                        <th class="border-b border-slate-200 px-4 py-3">Rank</th>
                        <th class="border-b border-slate-200 px-4 py-3">Username</th>
                        <th class="border-b border-slate-200 px-4 py-3">Accuracy</th>
                        <th class="border-b border-slate-200 px-4 py-3">Time</th>
                        <th class="border-b border-slate-200 px-4 py-3">Mistakes</th>
                        <th class="border-b border-slate-200 px-4 py-3">Played At</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($scores as $index => $score): ?>
                        <tr class="hover:bg-slate-50">
                            <td class="border-b border-slate-100 px-4 py-3 font-semibold">
                                #<?php echo $index + 1; ?>
                            </td>

                            <td class="border-b border-slate-100 px-4 py-3">
                                <?php echo htmlspecialchars($score["username"]); ?>
                            </td>

                            <td class="border-b border-slate-100 px-4 py-3">
                                <?php echo number_format($score["mistakes"], 2); ?>%
                            </td>

                            <td class="border-b border-slate-100 px-4 py-3">
                                <?php echo number_format($score["time_taken"], 2); ?>s
                            </td>

                            <td class="border-b border-slate-100 px-4 py-3">
                                <?php echo $score["mistakes"]; ?>
                            </td>

                            <td class="border-b border-slate-100 px-4 py-3 text-slate-600">
                                <?php echo date("H:i", strtotime($score["created_at"])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
</main>

</body>
</html>