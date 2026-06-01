<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Type Racing</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">
    <nav class="mb-4 border border-slate-300 bg-white p-4 shadow-sm">
        <div class="flex gap-4">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-semibold text-slate-900">Type Racing</h1>
            </div>
            <div class="flex items-center justify-center gap-4 text-md">
                <a href="#">Home</a>
                <a href="#">Play</a>
                <a href="#">Leaderboard</a>
            </div>
        </div>
    </nav>

    <main class="space-y-6">
        <div class="max-w-xs rounded border border-slate-200 bg-slate-50 ml-40 p-3 text-sm text-slate-700 shadow-sm">
            <div>Timer: <span id="timerDisplay">00:00</span></div>
            <div>Accuracy: <span id="accuracyDisplay">100%</span></div>
        </div>

        <section class="border border-slate-300 bg-white p-6 m-20 shadow-sm">
            <p class="block text-sm font-medium text-slate-700">Type the phrase here</p>
            <div class="border border-slate-200 bg-slate-50 p-4 text-slate-700 shadow-sm">
                The quick brown fox jumps over the lazy dog.
            </div>
        </section>
    </main>
</body>

</html>