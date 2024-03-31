<?php
session_start();

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

// Check if session is active and user is logged in
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["email"])) {
    // Retrieve logged user's email from session
    $email = $_SESSION["email"];

    // Retrieve user's details from database
    $stmt = $conn->prepare("SELECT * FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user's details
        $user = $result->fetch_assoc();

        // Retrieve form data
        $movietitle = $_POST["movie"];
        $showtime = $_POST["showtime"];
        $seats = $_POST["seats"]; // Seats should be an array of selected seat numbers
        $customername = $user["fullname"]; // Assuming the user's full name is stored in the database
        $contactno = $user["contactno"]; // Assuming the user's contact number is stored in the database

        // Check if seats array is set and not empty
        if (isset($seats) && !empty($seats)) {
            // Insert bookings into database
            $stmt = $conn->prepare("INSERT INTO bookings (movietitle, showtime, seatnumber, customername, contactno) VALUES (?, ?, ?, ?, ?)");
            foreach ($seats as $seat) {
                $stmt->bind_param("sssss", $movietitle, $showtime, $seat, $customername, $contactno);
                $stmt->execute();
            }

            // Check if booking(s) were successfully added
            if ($stmt->affected_rows > 0) {
                // Bookings added successfully
                echo "<script>alert('Booking(s) added successfully!');</script>";
                echo "<script>window.location.href = '../index.html';</script>"; // Redirect to homepage
            } else {
                // Failed to add bookings
                echo "<script>alert('Failed to add booking(s). Please try again.');</script>";
            }

            // Close statement
            $stmt->close();
        } else {
            // No seats selected
            echo "<script>alert('Please select at least one seat.');</script>";
            echo "<script>window.location.href = '../tickets.php';</script>"; // Redirect to select seats page
        }
    } else {
        // User not found in the database
        echo "<script>alert('User not found. Please log in again.');</script>";
        echo "<script>window.location.href = '../login.html';</script>"; // Redirect to login page
    }
} else {
    // No active session or user not logged in
    echo "<script>alert('Please log in to book seats.');</script>";
    echo "<script>window.location.href = '../login.html';</script>"; // Redirect to login page
}

// Close connection
$conn->close();
?>
