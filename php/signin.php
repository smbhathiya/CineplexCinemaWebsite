<?php
// Start session
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
    die("Connection Failed" . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Fetch the hashed password from the database
    $sql = "SELECT password FROM customers WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        // Check if the entered password matches the hashed password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
            // Show success alert
            echo "<script>alert('Login successful');</script>";
            echo "<script>window.location.href='../showtimes.php';</script>";
            exit;
        } else {
            // Password is incorrect, redirect back to login page with error message
            echo "<script>alert('Incorrect email or password. Please try again.');</script>";
            echo "<script>window.location.href='../login.html?error=1';</script>";
            exit;
        }
    } else {
        // User not found, redirect back to login page with error message
        echo "<script>alert('User not found. Please check your email.');</script>";
        echo "<script>window.location.href='../login.html?error=1';</script>";
        exit;
    }
}

// Close connection
$conn->close();
