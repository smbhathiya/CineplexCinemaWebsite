<?php
session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "cineplexdb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION["email"])) {
    // User is not logged in, redirect to login page
    header("Location: login.html");
    exit;
}

// Check if form is submitted and booking details are provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["movietitle"]) && isset($_POST["showtime"]) && isset($_POST["seatnumber"])) {
    $movietitle = $_POST["movietitle"];
    $showtime = $_POST["showtime"];
    $seatnumber = $_POST["seatnumber"];

    // Retrieve user's fullname from session
    $fullname = $_SESSION["fullname"]; // Use the correct session variable name

    // Delete the booking from the database
    $stmt = $conn->prepare("DELETE FROM bookings WHERE movietitle = ? AND showtime = ? AND seatnumber = ? AND customername = ?");
    $stmt->bind_param("ssss", $movietitle, $showtime, $seatnumber, $fullname);

    if ($stmt->execute()) {
        // Booking canceled successfully
        echo "<script>alert('Booking canceled successfully');</script>";
        echo "<script>console.log('Booking canceled successfully');</script>";
    } else {
        // Failed to cancel booking
        echo "<script>alert('Failed to cancel booking');</script>";
        echo "<script>console.error('Failed to cancel booking');</script>";
    }

    // Close statement
    $stmt->close();
} else {
    // Invalid request, redirect to user profile page
    header("Location: ../profile.php");
    exit;
}

// Close connection
$conn->close();

// Redirect to user profile page
header("Location: ../profile.php");
exit;
?>
