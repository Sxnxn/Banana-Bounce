<?php
include '../Controller/config.php';
if (!$_SESSION['loggedIn']) {
    redirect("login.php");
}

if (isset($_GET['new'])) {
    echo '<script>localStorage.removeItem("timeLeft");</script>';
    echo '<script>localStorage.removeItem("score");</script>';
    echo '<script>localStorage.removeItem("numQuestions");</script>';
    echo '<script>localStorage.removeItem("currentLevel");</script>';

    echo '<script>const currentURL = new URL(window.location.href);</script>';
    echo '<script>const searchParams = new URLSearchParams(currentURL.search);</script>';
    echo '<script>searchParams.delete("new");</script>';
    echo '<script>history.replaceState({}, "", `${currentURL.pathname}?${searchParams.toString()}`);</script>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Static Assets/css/player.css" type="text/css">
    <script src="../Static Assets/js/bgAudio.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>QUEEZY BUNCH</title>
    <script>
        let timeLeft = localStorage.getItem('timeLeft') || 45;
        let score = localStorage.getItem('score') || 0;
        let numQuestions = localStorage.getItem('numQuestions') || 1;
        let currentLevel = localStorage.getItem('currentLevel') || 1;
        let timer;
        let imgApi;
        let solution;
        let correctAnsSound = new Audio("../Static Assets/assets/audio/goThrough.mp3");
        let wrongAnsSound = new Audio("../Static Assets/assets/audio/incorrect.mp3");
        let levelUpSound = new Audio("../Static Assets/assets/audio/levelComplete.mp3");
        let timeOutSound = new Audio("../Static Assets/assets/audio/timesUp.mp3");

        function updateUI() {
            document.getElementById("question-number").textContent = numQuestions;
            document.getElementById("score").textContent = score;
            document.getElementById("timer").textContent = timeLeft;
            document.getElementById("level-no").textContent = currentLevel;
        }

        function handleTimeOut() {
            clearInterval(timer);
            timeOutSound.play(); //play tone when time is up
            Swal.fire({
                title: "Time's UP !",
                text: "Time's up! Game Over.",
                icon: "error"
            });

            if (currentLevel > 1) {
                Swal.fire({
                    title: "Level Passed",
                    text: "Congratulations! You have completed Level " + (currentLevel - 1) + ".",
                    icon: "success"
                });
            }

            resetGame();
        }

        function handleInput() {
            if (timeLeft > 0) {
                let answer = document.getElementById("answer").value;
                if (answer !== "") {
                    if (answer == solution) {
                        score++;
                        numQuestions++;
                        updateUI();

                        if (numQuestions > 5) {
                            handleCorrectAnswer();
                        } else {
                            fetchImage();
                        }
                        correctAnsSound.play(); //play tone when asnwer is correct
                        Swal.fire({
                            title: "Answered !",
                            icon: "success"
                        });
                    } else {
                        wrongAnsSound.play(); //play tone when asnwer is wrong
                        Swal.fire({
                            title: "Wrong Answer",
                            text: "That answer is wrong",
                            icon: "error"
                        });
                    }
                } else {
                    Swal.fire({
                        title: "Empty Answer",
                        text: "Please enter an answer",
                        icon: "error"
                    });
                }
            } else {
                Swal.fire({
                    title: "Time's UP !",
                    text: "Time's up! Game Over.",
                    icon: "error"
                });
                resetGame();
            }
        }

        function handleCorrectAnswer() {
            levelUpSound.play(); //play tone when level is up
            Swal.fire({
                title: "Level Passed",
                text: "Congratulations! You have completed Level " + (currentLevel - 1) + ".",
                icon: "success"
            });
            currentLevel++;
            numQuestions = 1;
            fetchImage();
        }

        function fetchImage() {
            fetch('https://marcconrad.com/uob/banana/api.php')
                .then(response => response.json())
                .then(data => {
                    imgApi = data.question;
                    solution = data.solution;
                    document.getElementById("imgApi").src = imgApi;
                    // document.getElementById("note").innerHTML = 'Ready?';
                    clearInterval(timer);
                    timer = setInterval(() => {
                        timeLeft--;
                        document.getElementById("timer").textContent = timeLeft;
                        if (timeLeft <= 0) {
                            handleTimeOut();
                        }
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error fetching image from the API:', error);
                });
        }

        function resetGame() {
            fetch('../Controller/updateScore.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        score: score
                    }),
                })

                .then(response => response.json())

                .then(data => {
                    console.log(data);
                })

                .catch(error => {
                    console.error('Error:', error);
                });

            timeLeft = 45;
            score = 0;
            numQuestions = 1;
            currentLevel = 1;
            updateUI();
            fetchImage();
        }

        window.addEventListener('beforeunload', function() {
            localStorage.setItem('timeLeft', timeLeft);
            localStorage.setItem('score', score);
            localStorage.setItem('numQuestions', numQuestions);
            localStorage.setItem('currentLevel', currentLevel);
        });

        document.addEventListener("DOMContentLoaded", function() {
            updateUI();
            fetchImage();
        });
    </script>
    <style>
        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }

        .imgApi {
            flex: 2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .imgApi img {
            max-width: 100%;
            height: auto;
            border: 2px solid #ccc;
            border-radius: 8px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 60px;
            padding: 30px;
            border-radius: 42px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            height: 100%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: #ffd90050;
        }


        .single-Data {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 1.2em;
            justify-content: center;
        }

        .single-Data span {
            background-color: #f4dda5;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #423616;
        }

        .ans-align {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .input-field {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
        }

        .content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .txtAns {
            font-size: 30px;
            color: #584e15;
            font-weight: bold;
            font-family: Cursive;
        }

        .bounce-animation {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-20px);
            }

            60% {
                transform: translateY(-10px);
            }
        }
    </style>

</head>

<body>
    <div class="video-container">
        <video autoplay muted loop>
            <source src="../Static Assets/assets/video/gameplaybg.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <nav class="navbar">
        <h1 class="logo">BANANA BOUNCE</h1>
        <div class="links">
            <a href="index.php"><i class="bi bi-house custom-icon"></i></i></a>
            <a href="scores.php"><i class="bi bi-123 custom-icon"></i></a>
            <a href="profile.php"><i class="bi bi-person-fill custom-icon"></i></i></a>
            <a href="../Controller/logout.php"><i class="bi bi-person-walking custom-icon"></i></a>
            <button class="" id="mutebtn"><i class="bi bi-volume-up-fill"></i></button>
        </div>
    </nav>

    <div class="container d-flex align-items-center justify-content-between mt-5">
        <!-- Image on the left -->
        <div class="imgApi">
            <img src="" alt="Question Image" id="imgApi" class="color-image">
        </div>

        <!-- Form and game data on the right -->
        <div class="form-container mx-4">
            <div class="single-Data">
                <span>Level <span id="level-no" class="fw-bold">1</span></span>
                <span>Question <span id="question-number" class="fw-bold">1</span></span>
                <span>Score <span id="score" class="fw-bold">0</span></span>
                <span>Time <span id="timer" class="fw-bold">45</span></span>
            </div>
            <div class="ans-align">
                <p class="txtAns bounce-animation">Hurry up, do your best!</p>
                <input type="number" class="input-field" id="answer" name="input" placeholder="Enter Answer" min="0">
                <button type="submit" class="btnGo mt-5" onclick="handleInput()">Click Me :)</button>
            </div>
            <div id="note"></div>
        </div>
    </div>

    <audio id="music">
        <source type="audio/mp3" src="../Static Assets/assets/audio/bg_music.mp3">
    </audio>

</body>

</html>