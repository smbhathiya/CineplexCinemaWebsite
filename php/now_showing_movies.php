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
$sql = "SELECT * FROM movies WHERE status='now';";

$result = $conn->query($sql);
session_start();

$movies = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Combine the base path and image ID to get the full image path
    $row['image_path'] = "./images/posters/" . $row['id'] . ".jpg";
    $movies[] = $row;
  }
}

$conn->close();

// Check for encoding errors
if (json_encode($movies) === false) {
  echo "Error encoding data to JSON";
} else {
  echo json_encode($movies);
}
