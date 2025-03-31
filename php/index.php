<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $track = $_POST['track']; // Determines the table
    $college = $_POST['college'];
    $qualification = $_POST['qualification'];
    $referral = $_POST['referral'];

    // Validate track and assign table dynamically
    $valid_tracks = ['ML', 'DL', 'WD'];
    if (!in_array($track, $valid_tracks)) {
        die("Invalid track selected.");
    }

    // Generate Custom ID for the Selected Track
    $prefix = "HT-$track"; // Example: HT-ML, HT-DL, HT-WD

    // Get the latest ID from the table
    $query = "SELECT id FROM $track ORDER BY id DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastId = $row['id'];
        $number = intval(substr($lastId, -5)) + 1; // Extract last 5 digits and increment
    } else {
        $number = 200; // Start from 00200
    }

    $newId = $prefix . sprintf("%05d", $number); // Format as HT-ML00200

    // Insert data into the selected track's table
    $sql = "INSERT INTO $track (id, name, gender, phone, college, qualification, referral) 
            VALUES ('$newId', '$name', '$gender', '$phone', '$college', '$qualification', '$referral')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful! Your ID: $newId'); window.location='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
