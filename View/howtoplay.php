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

        .animated-image {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            cursor: pointer;
            visibility: hidden;
            opacity: 0;
            z-index: 1000;
            transition: opacity 0.5s ease, transform 0.3s ease;
        }

        @keyframes scaleInOut {

            0%,
            100% {
                transform: translate(-50%, -50%) scale(1);
            }

            50% {
                transform: translate(-50%, -50%) scale(1.2);
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.querySelector('#carouselExampleControls');
            const animatedImage = document.querySelector('.animated-image');

            animatedImage.style.opacity = '0';
            animatedImage.style.visibility = 'hidden';

            carousel.addEventListener('slid.bs.carousel', function() {
                const activeItem = carousel.querySelector('.carousel-item.active');
                const isLastSlide = !activeItem.nextElementSibling;

                if (isLastSlide) {
                    animatedImage.style.visibility = 'visible';
                    animatedImage.style.opacity = '1';
                    animatedImage.style.animation = 'scaleInOut 2s infinite ease-in-out';
                }
            });
        });
    </script>
</head>

<body>

    <div class="video-container">
        <video autoplay muted loop>
            <source src="../Static Assets/assets/video/instructionbg.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>


    <nav class="navbar">
        <h1 class="logo">BANANA BOUNCE</h1>
        <div class="links">
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="profile.php">Hi, <?= $_SESSION['user_name']; ?></a>
            <?php } ?>
            <a href="scores.php"><i class="bi bi-123 custom-icon"></i></a>
            <a href="index.php"><i class="bi bi-house custom-icon"></i></a>
            <a href="../Controller/logout.php"><i class="bi bi-person-walking custom-icon"></i></a>
            <button class="" id="mutebtn"><i class="bi bi-volume-up-fill"></i></button>
        </div>
    </nav>

    <div class="container">

        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../Static Assets/assets/images/instructions/step1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../Static Assets/assets/images/instructions/step2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../Static Assets/assets/images/instructions/step3.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../Static Assets/assets/images/instructions/step4.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../Static Assets/assets/images/instructions/step5.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <a href="singlePlayer.php?new=true">
            <img src="../Static Assets/assets/images/playbtn.png" alt="Start Playing" class="animated-image" />
        </a>
    </div>
    <audio id="music">
        <source type="audio/mp3" src="../Static Assets/assets/audio/bg_music.mp3">
    </audio>
</body>

</html>