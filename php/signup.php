<?php
// Start session
session_start();

// Database credentials
$servername="localhost";
$username="root";
$password="";
$database="cineplexdb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection Failed" . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $contactno = $_POST["contactno"];
    $password = $_POST["password"];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Create a query to insert data into the table
    $sql = "INSERT INTO customers (fullname, email, contactno, password) VALUES ('$fullname', '$email', '$contactno', '$hashed_password')";

    if ($conn->query($sql) === true) {
        // Show success message and redirect to home page
        echo "<script>alert('Account Created successfully');</script>";
        echo "<script>window.location.href = '../login.html';</script>";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
