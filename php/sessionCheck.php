<?php
session_start();

// Check if user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // User is logged in
    $email = $_SESSION["email"];
    echo "Logged in as: $email";
} else {
    // User is not logged in
    echo "Not logged in";
}
