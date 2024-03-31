<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movies - Cineplex Movie Theater</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="icon" type="image/png" href="../images/logo-cover.png">
  <style>
    .container-add-margin {
      margin-top: 20px;
    }

    .card {
      background-color: #212529;
      border: none;
      color: #ffffff;
    }

    .card img {
      max-width: 100%;
      height: auto;
    }

    .card-title {
      color: #ffffff;
    }

    .card-body {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>
</head>

<body class="bg-dark">

  <!-- Navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand" href="../index.html">
        <img src="../images/logo-100.png" alt="Cinema Hall Logo" id="logo">
      </a>

      <!-- Toggler button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../index.html">Home</a>
          </li>
          <li class="nav-item">
            <?php session_start(); ?>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
              <a class="nav-link" href="../showtimes.php">Tickets Booking</a>
            <?php else : ?>
              <a class="nav-link" href="#" onclick="showAlert()">Tickets Booking</a>
            <?php endif; ?>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contact.html">Contact us</a>
          </li>
          <?php
          if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo
            '<li class="nav-item">
                      <a class="nav-link" href="#" onclick="confirmSignOut()">Sign out</a>
                      </li>

                      <li class="nav-item">
                      <a class="nav-link" href="../profile.php" style="color: #dc143c;">Profile</a>
                      </li>';
          } else {
            echo '<li class="nav-item">
                        <a class="nav-link" href="../login.html">Sign in</a>
                      </li>';
          }
          ?>
        </ul>

        <!-- Search form -->
        <form class="search-form d-flex justify-content-end" action="search.php" method="GET">
          <input class="form-control me-2 search-input" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-primary custom-btn" type="submit">Search</button>
        </form>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid p-5" style="color: white;">
    <div class="row">
      <div class="col-md-12 text-center mb-4">
        <h1 class="display-4">Search Results</h1>
      </div>
    </div>

    <div class="row justify-content-center">
      <?php
      // Database connection
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "cineplexdb";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $database);

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Process search query
      if (isset($_GET['search'])) {
        $search = $_GET['search'];

        // Check if search query is empty
        if (empty($search)) {
          echo "<div class='col-md-12 text-center'>
                      <div class='alert alert-danger' role='alert'>
                        Please enter a movie title.
                      </div>
                    </div>";
        } else {
          echo "<div class='col-md-12'>
          <h2 style='text-align: left;'>SEARCH RESULT: " . htmlspecialchars($search) . "</h2>
        </div>";

          // Prepare SQL statement to search for movies
          $sql = "SELECT * FROM movies WHERE title LIKE '%$search%'";

          // Execute the query
          $result = $conn->query($sql);

          // Check if any results were found
          if ($result->num_rows > 0) {
            // Open container div
            echo "<div class='container'>";
            echo "<div class='row justify-content-left'>";
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
      ?>
              <div class="col-md-2" style="margin: 20px;">
                <div class="card">
                  <div class="card-img-top position-relative">
                    <img src="../images/posters/<?php echo $row['id']; ?>.jpg" class="img-fluid" alt="<?php echo $row['title']; ?> Poster">
                    <div class="movie-title-overlay">
                      <h5 class="movie-title"><?php echo $row['title']; ?></h5>
                      <a href="<?php echo $row['moredetails']; ?>" class="btn btn-success main-c-b btn-sm mt-3" target="_blank">More Details</a>
                    </div>
                  </div>
                </div>
              </div>
      <?php
            }
            // Close container div
            echo "</div>";
            echo "</div>";
          } else {
            echo "<div class='col-md-12 text-center'>
                          <div class='alert alert-warning' role='alert'>
                            Movie is not available. Please try a different search.
                          </div>
                        </div>";
          }
        }
      }
      ?>




    </div>
  </div>



  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script>
    function showAlert() {
      var confirmation = confirm("Please log in to book seats. Do you want to proceed to login?");
      if (confirmation == true) {
        window.location.replace("../login.html");

      }
    }

    function confirmSignOut() {
      var answer = confirm("Are you sure you want to sign out?");
      if (answer) {
        window.location.href = "logout.php";
      }
    }
  </script>
</body>

</html>