<?php
// Fetch latest batch number
$sql = "SELECT MAX(batch_no) AS last_batch FROM batch";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$next_batch_no = ($row['last_batch'] ?? 0) + 1;

// Handle form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if (!empty($start_date) && !empty($end_date)) {
        $stmt = $conn->prepare("INSERT INTO batch (start_date, end_date) VALUES (?, ?)");
        $stmt->bind_param("ss", $start_date, $end_date);
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Batch $next_batch_no created successfully.</div>";
            header("Refresh: 1; url=create_batch.php"); // Refresh page after 1 second
            exit();
        } else {
            $message = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } else {
        $message = "<div class='alert alert-warning'>Please enter both dates.</div>";
    }
}
?>