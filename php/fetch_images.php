<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cineplexdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch image IDs from the database table
$sql = "SELECT id FROM movies"; // Assuming 'id' is the column storing image IDs
$result = $conn->query($sql);

$imageIDs = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imageIDs[] = $row['id'];
    }
}

// Close connection
$conn->close();

// Construct image paths by appending '.jpg' to image IDs
$imagePaths = array_map(function ($id) {
    return "./images/posters/" . $id . ".jpg";
}, $imageIDs);

// Output image paths as JSON
echo json_encode($imagePaths);
