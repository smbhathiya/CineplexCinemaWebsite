<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cineplexdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch movie data from the database
$sql = "SELECT * FROM movies WHERE status='now';";
$result = $conn->query($sql);
$movies = [];

if ($result->num_rows > 0) {
    // Fetching results from database and adding them to the movies array
    while ($row = $result->fetch_assoc()) {
        // Decoding the timings array from the database
        $timings = json_decode($row['timings'], true);

        $movies[] = [
            'title' => $row['title'],
            'id' => $row['id'],
            'moredetails' => $row['moredetails'],
            'showtimes' => $timings // Include the decoded array of timings
        ];
    }
} else {
    echo "0 results";
}

// Convert the movies array to JSON format and output it
echo json_encode($movies);

$conn->close();
