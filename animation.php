<?php
session_start();
$custom_id = $_SESSION['custom_id'] ?? 'HT-XXXXX';
$name = $_SESSION['name'] ?? 'Intern';

include 'config.php'; 

$track_prefix = strtoupper(substr($custom_id, 3, 2)); 

$table = '';
if ($track_prefix == 'DL') {
    $table = 'dl';
} elseif ($track_prefix == 'WD') {
    $table = 'wd';
} elseif ($track_prefix == 'ML') {
    $table = 'ml';
} else {
    die("Invalid track prefix in custom ID");
}

$query = "SELECT id FROM $table WHERE id = '$custom_id' LIMIT 1";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Internship Application Loading</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: #eef2f7;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      position: relative;
      overflow: hidden;
    }

    .container {
      display: flex;
      background: white;
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      max-width: 950px;
      width: 90%;
      flex-wrap: wrap;
    }

    .text-box {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      padding: 15px;
    }

    .line {
      font-size: 1.2rem;
      color: #222;
      margin-bottom: 8px;
      white-space: nowrap;
      overflow: hidden;
      border-right: 2px solid #007bff;
      width: fit-content;
      animation: blinkCursor 0.7s infinite;
    }

    .offer-button {
      background: radial-gradient(circle, rgba(89,6,150,1) 21%, rgba(140,82,255,1) 76%);
      color: white;
      padding: 15px 25px;
      border-radius: 10px;
      margin: 20px auto 10px;
      text-decoration: none;
      font-size: 1rem;
      display: inline-block;
    }

    .offer-button-text {
      font-size: 0.7em;
    }

    .lottie-box dotlottie-player,
    .success dotlottie-player {
      width: 250px !important;
      height: 250px !important;
    }

    .success {
      display: none;
      flex-direction: column;
      align-items: center;
      text-align: center;
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 1500px; /* increase this value as needed */
      margin: 0 auto;
    }

    .success-message {
      font-size: 1.6rem;
      font-weight: bold;
      margin-top: 15px;
      color: #590696;
      background: white;
      padding: 25px 20px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      max-width: 90%;
    }

    .confetti {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      z-index: 0;
      pointer-events: none;
    }

    @keyframes blinkCursor {
      0%, 100% { border-color: transparent; }
      50% { border-color: #007bff; }
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column-reverse;
        align-items: center;
        padding: 20px;
      }

      .text-box {
        text-align: center;
        padding-top: 25px;
        align-items: center;
      }

      .line {
        font-size: 1rem;
      }

      .offer-button {
        font-size: 0.95rem;
        padding: 12px 20px;
      }

      .success-message {
        font-size: 1.3rem;
        padding: 40px 30px;
      }

      .lottie-box dotlottie-player,
      .success dotlottie-player {
        width: 200px !important;
        height: 200px !important;
      }
    }
  </style>
</head>
<body>

  <div class="container" id="loadingContainer">
    <div class="text-box" id="textBox"></div>
    <div class="lottie-box">
      <dotlottie-player
        src="https://lottie.host/5be90acd-01f8-4d9b-beee-95818ac2c16b/D2vmSjCXwQ.lottie"
        background="transparent"
        speed="1"
        loop
        autoplay>
      </dotlottie-player>
    </div>
  </div>

  <div class="success" id="successContainer">
    <dotlottie-player
      src="https://lottie.host/fb2178d0-1e7d-4ad8-a142-4d32f4a964bf/xyDS2XoCA5.lottie"
      background="transparent"
      speed="1"
      loop
      autoplay>
    </dotlottie-player>
    <div class="success-message">
      🎉 Congratulations <?php echo htmlspecialchars($name); ?>!<br>
      You are selected for the internship.<br><br>
      Your ID: <strong><?php echo $custom_id; ?></strong>
      
      <?php
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $id = htmlspecialchars($row['id']);
              $pdfLink = '';

              if ($track_prefix == 'WD') {
                  $pdfLink = "http://localhost/stellar/wd_pdf.php?id=$id";
              } elseif ($track_prefix == 'ML') {
                  $pdfLink = "http://localhost/stellar/ml_pdf.php?id=$id";
              } elseif ($track_prefix == 'DL') {
                  $pdfLink = "http://localhost/stellar/dl_pdf.php?id=$id";
              }
      ?>
              <div class="mb-3">
                  <a href="<?= $pdfLink ?>" class="offer-button">Download Offer Letter</a>
              </div>
              <div class="mb-3">
                  <a href="" class="offer-button-text" target="_blank">Join WhatsApp Group</a>
              </div>
      <?php
          }
      } else {
          echo "<p>No results found for the custom ID: $custom_id in track: $track_prefix</p>";
      }
      ?>
    </div>
  </div>

  <dotlottie-player class="confetti"
    src="https://lottie.host/64a66f41-d47f-4ec8-8222-ba6a2a34c882/V2qPs3Udsu.lottie"
    background="transparent"
    speed="1"
    loop
    autoplay>
  </dotlottie-player>

  <script>
    const messages = [
      "Analyzing your profile...",
      "Accessing your educational background...",
      "Reviewing internship preferences...",
      "Matching you with relevant roles...",
      "Validating certifications and achievements...",
      "Checking skill compatibility...",
      "Finalizing application insights..."
    ];

    const totalDuration = 5000;
    const delayPerMessage = totalDuration / messages.length;
    const textBox = document.getElementById('textBox');
    const loadingContainer = document.getElementById('loadingContainer');
    const successContainer = document.getElementById('successContainer');
    const confetti = document.querySelector('.confetti');
    confetti.style.display = 'none';

    let currentMessage = 0;

    function typeMessage(message, callback) {
      const line = document.createElement('div');
      line.className = 'line';
      textBox.appendChild(line);
      let i = 0;
      const intervalTime = delayPerMessage / message.length;
      const typingInterval = setInterval(() => {
        line.textContent += message[i];
        i++;
        if (i === message.length) {
          clearInterval(typingInterval);
          line.style.borderRight = "none";
          setTimeout(callback, 100);
        }
      }, intervalTime);
    }

    function loopMessages() {
      if (currentMessage < messages.length) {
        typeMessage(messages[currentMessage], () => {
          currentMessage++;
          loopMessages();
        });
      } else {
        setTimeout(() => {
          loadingContainer.style.display = 'none';
          successContainer.style.display = 'flex';
          confetti.style.display = 'block';
        }, 300);
      }
    }

    loopMessages();
  </script>

</body>
</html>
