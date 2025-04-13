<?php
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>404 Not Found</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9f9f9;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      height: 100vh;
      text-align: center;
    }

    h1 {
        font-size: 4em;
        font-weight: bold;
        background: radial-gradient(circle, rgba(89,6,150,1) 21%, rgba(140,82,255,1) 76%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block; 
    }

    p {
      font-size: 1.2rem;
      color: #666;
      margin-bottom: 30px;
    }

    dotlottie-player {
      width: 400px;
      height: 400px;
      max-width: 90vw;
    }

    @media (max-width: 600px) {
      h1 {
        font-size: 2rem;
      }
      p {
        font-size: 1rem;
      }
      dotlottie-player {
        width: 280px;
        height: 280px;
      }
    }
  </style>
</head>
<body>
  <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
  
  <dotlottie-player
    src="https://lottie.host/0d9da880-0bd1-4bb0-9223-ca1aacea9721/1i7FgCOzmH.lottie"
    background="transparent"
    speed="1"
    loop
    autoplay>
  </dotlottie-player>

  <h1>404 - Page Not Found</h1>
  <p>The page you're looking for doesn't exist or has been moved.</p>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>
