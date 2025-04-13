<?php
session_start();
include 'config.php';
include 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $track = $_POST['track'];
    $college = $_POST['college'];
    $qualification = $_POST['qualification'];
    $referral = $_POST['referral'];

    $valid_tracks = ['ML', 'DL', 'WD'];
    if (!in_array($track, $valid_tracks)) {
        die("Invalid track selected.");
    }

    $prefix = "HT-$track";

    $query = "SELECT id FROM $track ORDER BY id DESC LIMIT 1";
    $result = $conn->query($query);
    $number = ($result->num_rows > 0) ? intval(substr($result->fetch_assoc()['id'], -5)) + 1 : 200;
    $newId = $prefix . sprintf("%05d", $number);

    $batchQuery = "SELECT batch_no, start_date, end_date FROM batch ORDER BY batch_no DESC LIMIT 1";
    $batchResult = $conn->query($batchQuery);
    if ($batchResult->num_rows > 0) {
        $batchRow = $batchResult->fetch_assoc();
        $batch_no = $batchRow['batch_no'];
        $start_date = $batchRow['start_date'];
        $end_date = $batchRow['end_date'];
    } else {
        $batch_no = "Not Assigned";
        $start_date = "0000-00-00";
        $end_date = "0000-00-00";
    }

    $sql = "INSERT INTO $track (id, name, gender, phone, email, college, qualification, referral, batch, start_date, end_date) 
            VALUES ('$newId', '$name', '$gender', '$phone', '$email', '$college', '$qualification', '$referral', '$batch_no', '$start_date', '$end_date')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['custom_id'] = $newId;
        $_SESSION['name'] = $name;
        // Redirect after processing the form, ensuring no HTML is outputted before this.
        header("Location: animation.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    #collegeSuggestions {
      max-height: 200px;
      overflow-y: auto;
      display: none;
      position: absolute;
      z-index: 1000;
      width: 100%;
    }

    #collegeSuggestions li {
      cursor: pointer;
    }
  </style>
</head>
<body>
<div class="container mt-5 pt-4">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h3 class="text-center">Registration Form</h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Gender</label>
          <select name="gender" class="form-select" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Track</label>
          <select name="track" class="form-select" required>
            <option value="ML">ML</option>
            <option value="DL">DL</option>
            <option value="WD">WD</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">College</label>
          <input type="text" name="college" id="college" class="form-control" autocomplete="off" oninput="searchColleges()">
          <ul id="collegeSuggestions" class="list-group position-absolute"></ul>
        </div>

        <div class="mb-3">
          <label class="form-label">Qualification</label>
          <input type="text" name="qualification" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Referral</label>
          <select name="referral" class="form-select" required>
            <option value="Friends">Friends</option>
            <option value="Instagram">Instagram</option>
            <option value="LinkedIn">LinkedIn</option>
            <option value="College">College</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit</button>
      </form>
    </div>
  </div>
</div>

<script>
function searchColleges() {
  const input = document.getElementById('college').value;
  const suggestionBox = document.getElementById('collegeSuggestions');
  
  if (input.length > 0) {
    suggestionBox.style.display = 'block';
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'search_colleges.php?q=' + encodeURIComponent(input), true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        const colleges = JSON.parse(xhr.responseText);
        suggestionBox.innerHTML = '';
        colleges.forEach(college => {
          const li = document.createElement('li');
          li.classList.add('list-group-item');
          li.textContent = college;
          li.onclick = () => {
            document.getElementById('college').value = college;
            suggestionBox.style.display = 'none';
          };
          suggestionBox.appendChild(li);
        });
      }
    };
    xhr.send();
  } else {
    suggestionBox.style.display = 'none';
  }
}
</script>

</body>
</html>
