<?php
$sentence = "Testing test"; //"De zomers in Nederland worden steeds heter en het is belangrijk dat mensen, vooral degenen met een kwetsbare gezondheid of mensen die buiten werken, goed zijn beschermd tijdens periodes van hitte";
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
                <a href="home.php">Home</a>
                <a href="game.php">Play</a>
                <a href="#">Leaderboard</a>
            </div>
        </div>
    </nav>

    <main class="space-y-6">
        <div class="flex justify-end px-4">
            <div class="max-w-xs rounded border border-slate-200 bg-slate-50 mr-16 p-5 text-md text-slate-700 shadow-sm">
                <div>WPM: <span id="wpmDisplay">0</span></div>
                <div>Timer: <span id="timerDisplay">00:00</span></div>
                <div>Mistakes: <span id="mistakesDisplay">0</span></div>
                <div>Accuracy: <span id="accuracyDisplay">100%</span></div>
            </div>
        </div>

        <section class="border border-slate-300 bg-white p-6 m-20 shadow-sm">
            <p class="block text-sm pb-6 font-medium text-slate-700">Type the phrase here</p>
            <div class="border border-slate-200 bg-slate-50 p-4 text-lg font-bold text-slate-700 shadow-sm" style="font-family: Courier, monospace; position: relative;">
                <span id="correct" class="bg-green-400 whitespace-pre-wrap"></span><span id="wrong" class="bg-red-400 whitespace-pre-wrap"></span><span class="caret"></span><span id="sentence" class="whitespace-pre-wrap"><?php echo $sentence; ?></span>
            </div>
        </section>
    </main>

    <form id="postForm" action="validate_score" method="POST" style="display: none;">
        <input type="hidden" name="startTime" id="formStartTime">
        <input type="hidden" name="endTime" id="formEndTime">
        <input type="hidden" name="mistakes" id="formMistakes">
        <input type="hidden" name="sentence" id="formSentence">
    </form>
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
        position: absolute;
        width: 0.9px;
        height: 1em;
        background-color: #000;
        margin: 0 1px;
        animation: blink 1s infinite;
    }
</style>

<script>
    const sentenceEle = document.getElementById('sentence');
    const correctInputEle = document.getElementById('correct');
    const wrongInputEle = document.getElementById('wrong');
    const accuracyEle = document.getElementById('accuracyDisplay');
    const mistakesEle = document.getElementById('mistakesDisplay');
    const timerEle = document.getElementById('timerDisplay');
    const wpmEle = document.getElementById('wpmDisplay');
    const sentence = sentenceEle.innerText;
    let written = "";
    let startTime = null;
    let inputs = 0;
    let mistakes = 0;

    function renderWritten() {
        if (!written) {
            correctInputEle.textContent = '';
            wrongInputEle.textContent = '';
            return;
        }

        const firstMistake = written.split('').findIndex((char, idx) => sentence[idx] !== char);
        if (firstMistake === -1) {
            correctInputEle.textContent = written;
            wrongInputEle.textContent = '';
        } else {
            correctInputEle.textContent = written.slice(0, firstMistake);
            wrongInputEle.textContent = written.slice(firstMistake);
        }
        sentenceEle.innerText = sentence.slice(written.length);

        if (written === sentence) {
            const endTime = Date.now();
            document.getElementById('formStartTime').value = startTime;
            document.getElementById('formEndTime').value = endTime;
            document.getElementById('formMistakes').value = mistakes;
            document.getElementById('formSentence').value = sentence;
            document.getElementById('postForm').submit();
        }
    }

    function updateAccuracy() {
        const accuracy = inputs === 0 ? 100 : Math.round(((inputs - mistakes) / inputs) * 100);
        accuracyEle.textContent = accuracy + '%';
    }

    function updateWPM(elapsedSeconds) {
        const elapsedMin = elapsedSeconds / 60;
        const wordsTyped = correctInputEle.textContent.split(' ').length - 1;
        const wpm = Math.round(wordsTyped / elapsedMin);
        wpmEle.textContent = wpm;
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('keydown', function(event) {
            let isPrintable = event.key && event.key.length === 1;
            if (isPrintable) {
                if (!startTime) {
                    startTime = Date.now();
                    setInterval(() => {
                        const elapsedTime = (Date.now() - startTime) / 1000;
                        timerEle.textContent = new Date(elapsedTime * 1000).toISOString().substr(14, 5);
                        updateWPM(elapsedTime);
                    }, 1000);
                }

                written += event.key;
                inputs++;
                renderWritten();
                if (sentence[written.length - 1] !== event.key) {
                    mistakes++;
                    mistakesEle.textContent = mistakes;
                }
                updateAccuracy();
            } else if (event.key === "Backspace") {
                event.preventDefault();
                written = written.slice(0, -1);
                renderWritten();
            }
        });
    });
</script>

</html>