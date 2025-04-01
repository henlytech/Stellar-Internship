<?php
include 'config.php'; // Assuming your database connection is in config.php

if (isset($_GET['q'])) {
    $searchTerm = $_GET['q'];
    
    // Prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
    
    // Query to search for colleges that match the input
    $query = "SELECT college FROM colleges WHERE college LIKE '%$searchTerm%' LIMIT 10";  // Assuming colleges table has a 'college' column
    $result = $conn->query($query);
    
    $colleges = [];
    while ($row = $result->fetch_assoc()) {
        $colleges[] = $row['college'];
    }
    
    echo json_encode($colleges); // Return the result as JSON
}
?>
