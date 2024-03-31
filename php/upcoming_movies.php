<?php
// Assuming you have a MySQL database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cineplexdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch movie data from the database
$sql = "SELECT title, id, moredetails,releasedate FROM movies WHERE status='soon';";
$result = $conn->query($sql);

$movies = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Combine the base path and image ID to get the full image path
        $row['image_path'] = "./images/posters/" . $row['id'] . ".jpg";
        $movies[] = $row;
    }
}

$conn->close();

// Output the movie data as JSON
echo json_encode($movies);
