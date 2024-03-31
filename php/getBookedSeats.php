<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "cineplexdb";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch booked seats for the selected movie and showtime from the database
$movietitle = $_POST['movietitle'];
$showtime = $_POST['showtime'];
$sql = "SELECT seatnumber FROM bookings WHERE movietitle = '$movietitle' AND showtime = '$showtime'";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Store booked seats in an array
$bookedSeats = [];
while ($row = $result->fetch_assoc()) {
    $bookedSeats[] = $row['seatnumber'];
}

// Return the booked seats as JSON
echo json_encode($bookedSeats);

// Close connection
$conn->close();
?>
