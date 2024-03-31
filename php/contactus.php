<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "cineplexdb";

// Create database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data from the contact form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO messages (fullname, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $message);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Your message has been sent successfully!');
              window.location.href = '../index.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
