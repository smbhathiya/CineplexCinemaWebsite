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

// Initialize variables
$fullname = $email = "";
$booking_result = null;

// Check if user is logged in
if (isset($_SESSION["email"])) {
    // Retrieve user's email from session
    $email = $_SESSION["email"];

    // Retrieve user's information from the database
    $stmt = $conn->prepare("SELECT fullname, email FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $fullname = $user["fullname"];
        $email = $user["email"];

        // Retrieve booked seats for the user
        $stmt = $conn->prepare("SELECT movietitle, showtime, seatnumber FROM bookings WHERE customername = ?");
        $stmt->bind_param("s", $fullname);
        $stmt->execute();
        $booking_result = $stmt->get_result();
    } else {
        echo "User not found";
    }

    // Set the correct session variable for fullname
    $_SESSION["fullname"] = $fullname;
} else {
    // User is not logged in, redirect to login page
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Cineplex Movie Theater</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/png" href="images/logo-cover.png">
</head>

<body class="bg-dark">

    <!-- Navigation bar  -->
    <div id="navbar-placeholder"></div>

    <div class="container mt-5">
        <h2 class="text-white">User Profile</h2>
        <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
            <!-- <div class="card-header">User Information</div> -->
            <div class="card-body">
                <h5 class="card-title">Name: <?php echo $fullname; ?></h5>
                <p class="card-text">Email: <?php echo $email; ?></p>
            </div>
        </div>

        <h3 class="text-white">Booked Seats:</h3>
        <?php if ($booking_result && $booking_result->num_rows > 0) : ?>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Movie Title</th>
                        <th scope="col">Showtime</th>
                        <th scope="col">Seat Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $booking_result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row["movietitle"]; ?></td>
                            <td><?php echo $row["showtime"]; ?></td>
                            <td><?php echo $row["seatnumber"]; ?></td>
                            <td>
                                <form action="./php/cancel_booking.php" method="post" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                    <input type="hidden" name="movietitle" value="<?php echo $row['movietitle']; ?>">
                                    <input type="hidden" name="showtime" value="<?php echo $row['showtime']; ?>">
                                    <input type="hidden" name="seatnumber" value="<?php echo $row['seatnumber']; ?>">
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-white">No bookings found.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <div id="footer-placeholder"></div>

    <script src="js/scripts.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Close connection
$conn->close();
?>