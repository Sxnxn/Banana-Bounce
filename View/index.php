<?php

include '../Controller/config.php';
if (!$_SESSION['loggedIn']) {
    redirect("login.php");
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
    <link rel="style" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../Static Assets/css/style.css" type="text/css">
    <script src="../Static Assets/js/bgAudio.js"></script>

    <title>QUEEZY BUNCH</title>

    <style>
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
            width: 100vw;
            height: 100vh;
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

        .animated-image {
            width: 150px;
            cursor: pointer;
            animation: moveLeftRight 2s infinite ease-in-out;
            transition: transform 0.3s ease;
        }

        @keyframes moveLeftRight {
            0% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(10px);
            }

            100% {
                transform: translateX(0);
            }
        }

        .animated-image:hover {
            transform: scale(1.33);
        }
    </style>
</head>

<body>

    <div class="video-container">
        <video autoplay muted loop>
            <source src="../Static Assets/assets/video/bg-home.mov" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <nav class="navbar">
        <h1 class="logo">BANANA BOUNCE</h1>
        <div class="links">
            <!-- <a href="howtoplay.php">HOW TO PLAY</a> -->
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="profile.php">Hi, <?= $_SESSION['user_name']; ?></a>
            <?php } ?>
            <a href="scores.php"><i class="bi bi-123 custom-icon"></i></a>
            <a href="../Controller/logout.php"><i class="bi bi-person-walking custom-icon"></i></a>
            <button class="" id="mutebtn"><i class="bi bi-volume-up-fill"></i></button>
        </div>
    </nav>
    <div class="container">
        <div class="content">
            <!-- <img id="quiz-image" src="../Static Assets/assets/images/icon quiz.png" alt=""> -->
            <!-- <h1 class="indexTitle">Whooo! Let’s Get Bananas</h1> -->
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="howtoplay.php" class="mt-4">
                    <img src="../Static Assets/assets/images/letsgobtn.png" alt="Start Playing" class="animated-image" />
                </a>
            <?php } ?>
        </div>
    </div>

    <audio id="music">
        <source type="audio/mp3" src="../Static Assets/../Static Assets/assets/audio/bg_music.mp3">
    </audio>
</body>

</html>