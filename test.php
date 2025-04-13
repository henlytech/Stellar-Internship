<?php
include 'config.php';
include 'navbar.php';

// Fetch distinct batches for dropdown
$batchList = [];
$tracks = ['ML', 'DL', 'WD'];

foreach ($tracks as $t) {
    $result = $conn->query("SELECT DISTINCT batch FROM $t");
    while ($row = $result->fetch_assoc()) {
        if (!in_array($row['batch'], $batchList)) {
            $batchList[] = $row['batch'];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Track & Batch Filter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 80px;
        }
        .form-section {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
        }
        .results-table {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-section shadow-sm">
                <h3 class="text-center mb-4">Filter Students by Track & Batch</h3>
                <form method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label for="track" class="form-label">Track</label>
                        <select name="track" class="form-select" required>
                            <option value="">Select Track</option>
                            <option value="ML">ML</option>
                            <option value="DL">DL</option>
                            <option value="WD">WD</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="batch" class="form-label">Batch</label>
                        <select name="batch" class="form-select" required>
                            <option value="">Select Batch</option>
                            <?php foreach ($batchList as $b): ?>
                                <option value="<?php echo $b; ?>"><?php echo $b; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary px-4">Fetch Data</button>
                    </div>
                </form>
            </div>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['track']) && isset($_POST['batch'])) {
                $track = $_POST['track'];
                $batch = $_POST['batch'];

                if (!in_array($track, $tracks)) {
                    echo '<div class="alert alert-danger mt-4">Invalid track selected.</div>';
                } else {
                    $stmt = $conn->prepare("SELECT id, name, email, phone, college FROM $track WHERE batch = ?");
                    $stmt->bind_param("s", $batch);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    echo "<div class='results-table'>";
                    echo "<h4 class='mt-5'>Results for <strong>$track</strong> Track, Batch <strong>$batch</strong></h4>";

                    if ($result->num_rows > 0) {
                        echo "<div class='table-responsive'>";
                        echo "<table class='table table-bordered table-striped table-hover mt-3'>
                                <thead class='table-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>College</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";

                        while ($row = $result->fetch_assoc()) {
                            $id = htmlspecialchars($row['id']);
                            $pdfLink = '';
                        
                            // Determine PDF link based on selected track
                            if ($track == 'WD') {
                                $pdfLink = "http://localhost/stellar/wd_pdf.php?id=$id";
                            } elseif ($track == 'ML') {
                                $pdfLink = "http://localhost/stellar/ml_pdf.php?id=$id";
                            } elseif ($track == 'DL') {
                                $pdfLink = "http://localhost/stellar/dl_pdf.php?id=$id";
                            }
                        
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['college']}</td>
                                    <td>
                                        <a href='$pdfLink' class='btn btn-sm btn-success' target='_blank'>
                                            Letter
                                        </a>
                                    </td>
                                </tr>";
                        }
                                
                        echo "</tbody></table></div>";
                    } else {
                        echo "<div class='alert alert-warning mt-3'>No records found for the selected batch.</div>";
                    }

                    echo "</div>";
                    $stmt->close();
                }
            }

            $conn->close();
            ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>