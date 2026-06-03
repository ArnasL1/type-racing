<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Type Racing - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">

<nav class="mb-4 border border-slate-300 bg-white p-4 shadow-sm">
    <div class="relative flex items-center justify-center w-full">
        <h1 class="absolute left-4 text-3xl font-semibold text-slate-900">Type Racing</h1>

        <div class="flex items-center gap-4 text-md">
            <a href="home.php" class="hover:text-blue-600">Home</a>
            <a href="game.php" class="hover:text-blue-600">Play</a>
            <a href="#" class="hover:text-blue-600">Leaderboard</a>
        </div>
    </div>
</nav>

<main class="mx-auto max-w-4xl px-6 py-10">
    <section class="rounded border border-slate-300 bg-white p-8 shadow-sm">
        <h2 class="mb-4 text-4xl font-bold text-slate-900">
            Welcome to Type Racing
        </h2>

        <p class="mb-4 text-lg text-slate-700">
            Type Racing is a simple typing game where you test how fast and accurate you can type.
            The goal is to copy the sentence shown on the screen as quickly as possible.
        </p>

        <p class="mb-4 text-lg text-slate-700">
            While you type, the game checks your input. Correct letters are marked green and mistakes
            are marked red. You can use backspace to fix your mistakes. At the end, the game can show
            how fast you were and how accurate your typing was.
        </p>

        <div class="mb-6 rounded border border-slate-200 bg-slate-50 p-5">
            <h3 class="mb-2 text-xl font-semibold text-slate-900">Rules</h3>

            <ul class="list-disc space-y-2 pl-6 text-slate-700">
                <li>Type the sentence exactly as it is shown.</li>
                <li>Try to type as fast as possible.</li>
                <li>Avoid mistakes to keep your accuracy high.</li>
                <li>Use backspace if you want to correct a mistake.</li>
            </ul>
        </div>

        <a href="game.php"
           class="inline-block rounded bg-blue-600 px-6 py-3 text-lg font-semibold text-white shadow-sm hover:bg-blue-700">
            Start Playing
        </a>
    </section>
</main>

</body>
</html>