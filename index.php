<?php
$sentence = "The quick brown fox&#8248; jumps over the lazy dog.";
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
        <div class="relative flex items-center justify-center w-full">
            <h1 class="absolute left-4 text-3xl font-semibold text-slate-900">Type Racing</h1>
            <div class="flex items-center gap-4 text-md">
                <a href="#">Home</a>
                <a href="#">Play</a>
                <a href="#">Leaderboard</a>
            </div>
        </div>
    </nav>

    <main class="space-y-6">
        <div class="flex justify-end px-4">
            <div class="max-w-xs rounded border border-slate-200 bg-slate-50 mr-16 p-5 text-md text-slate-700 shadow-sm">
                <div>Timer: <span id="timerDisplay">00:00</span></div>
                <div>Accuracy: <span id="accuracyDisplay">100%</span></div>
            </div>
        </div>

        <section class="border border-slate-300 bg-white p-6 m-20 shadow-sm">
            <p class="block text-sm pb-6 font-medium text-slate-700">Type the phrase here</p>
            <div class="border border-slate-200 bg-slate-50 p-4 text-md text-slate-700 shadow-sm" style="font-family: 'Arial Unicode MS', sans-serif;">
                <span id="displayText"></span><span class="caret"></span>
            </div>
        </section>
    </main>
</body>

<style>
    @keyframes blink {

        0%,
        49% {
            opacity: 1;
        }

        50%,
        100% {
            opacity: 0;
        }
    }

    .caret {
        display: inline-block;
        width: 0.9px;
        height: 1em;
        background-color: #000;
        margin: 0 1px;
        animation: blink 1s infinite;

    }
</style>

<script>
    const sentence = {
        <?php $sentence ?>
    };
    const displayText = document.getElementById('displayText');
    const maxLength = sentence.length;
    let written = "";

    document.addEventListener('DOMContentLoaded', function() {
        displayText.innerText = "";
        console.log("Loaded");
        document.addEventListener('keydown', function(event) {
            let isPrintable = event.key && event.key.length === 1;
            console.log(event.key);
            if (isPrintable) {
                written += event.key;
                displayText.innerText = written;
            } else if (event.key === "Backspace") {
                event.preventDefault();
                written = written.slice(0, -1);
                displayText.innerText = written;
            }
        });
    });
</script>

</html>