<?php

include '../Controller/config.php';
include '../Controller/loginHandler.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <link rel="stylesheet" href="../Static Assets/css/style.css" type="text/css">
    <script src="../Static Assets/js/bgAudio.js"></script>
    <title>BANANA BOUNCE</title>

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
    </style>
</head>

<body>

    <div class="video-container">
        <video autoplay muted loop>
            <source src="../Static Assets/assets/video/bg-video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <nav class="navbar">
        <a href="index.php" class="logo">
            <img src="../Static Assets/images/logo.png" alt="BANANA BOUNCE Logo" class="logo-img">
        </a>
    </nav>

    <div class="container">
        <div class="form-wrapper" id="formWrapper">
            <h1 class="text-center">BANANA BOUNCE</h1>
            <h3 class="text-center">WELCOME</h3>
            <form class="form-align" method="post">
                <div class="form-group">
                    <label for="email"><i class="bi bi-envelope-fill"></i></label>
                    <input type="email" class="input-field" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="bi bi-lock-fill"></i></i></label>
                    <input type="password" class="input-field" id="password" name="password" placeholder="Enter Password" required>

                </div>
                <div class="text-center">
                    <button class="loginbtn" id="loginbtn" name="login">Login</button>
                </div>
            </form>
            <div class="text-center">
                <h6 class="regtxt">Don't Have a Profile? </h6>
                <a href="register.php" id="reglink"><button class="regbtn" id="regbtn">Register</button></a>
            </div>
        </div>
    </div>
    <audio id="music">
        <source type="audio/mp3" src="../Static Assets/assets/audio/bg_music.mp3">
    </audio>
</body>

</html>