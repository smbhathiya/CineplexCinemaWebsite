<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Showtimes - Cineplex Movie Theater</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/png" href="images/logo-cover.png">
</head>

<body class="bg-dark">

  <!-- Navigation bar  -->
  <div id="navbar-placeholder"></div>

  <div class="container-add-margin"></div>
  <!-- Showtimes section -->
  <div class="container-fluid bg-dark ">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card bg-dark text-white ">
          <div class="card-body">
            <h2 class="text-center mb-4 main-c-t">SHOWTIME</h2>

            <!-- Showtimes -->
            <div id="movieContainer">
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

              // Fetch movie data from the database
              $sql = "SELECT * FROM movies WHERE status='now';";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $movieID = $row['id'];
                  $imageFileName = sprintf($movieID) . '.jpg'; // Constructing image filename with leading zero if needed
                  echo '
      <div class="mb-4">
        <div class="row align-items-center">
          <div class="col-md-6 text-center">
            <img src="images/posters/' . $imageFileName . '" class="img-fluid rounded movie-poster m-4" alt="' . $row['title'] . ' Poster">
          </div>
          <div class="col-md-6">
            <h4 class="text-white">' . $row['title'] . '</h4>
            <ul class="list-group">';
                  $timings = explode(",", $row['timings']);
                  foreach ($timings as $timing) {
                    // Remove brackets and quotation marks from timings
                    $timing = str_replace(['[', ']', '"'], '', $timing);
                    echo '<li class="list-group-item bg-dark text-white">' . $timing . '</li>';
                  }
                  echo '
                  </ul>
                <a href="tickets.php?movie=' . urlencode($row['title']) . '&id=' . $row['id'] . '&timings=' . urlencode($row['timings']) . '" class="btn btn-primary main-c-b mt-3">Book Ticket for ' . $row['title'] . '</a>

                </div>
                </div>
                </div>';
                }
              } else {
                echo "0 results";
              }
              $conn->close();
              ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div id="footer-placeholder"></div>

  <script src="js/scripts.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>