<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Tickets - Cineplex Movie Theater</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/png" href="images/logo-cover.png">
  <style>
    .available-seat {
      background-color: #009721;
    }

    .booked-seat {
      background-color: #dc143c;
    }

    #seat-selection {
      margin-top: 20px;
    }

    #seat-selection .row {
      margin-bottom: 10px;
    }

    #seat-selection .col-sm-1 {
      padding: 10px;
    }

    #seat-selection input[type="checkbox"] {
      display: none;
    }

    #seat-selection label {
      display: block;
      min-width: 35px;
      height: 30px;
      /* background-color: #009721; */
      border-radius: 5px;
      text-align: center;
      line-height: 30px;
      cursor: pointer;
    }

    #seat-selection label:hover {
      background-color: #0071ce;
    }

    #seat-selection input[type="checkbox"]:checked+label {
      background-color: #006dc7;
      color: #fff;
    }

    @media (max-width: 768px) {
      #seat-selection label {
        min-width: 25px;
      }
    }
  </style>
</head>

<body class="bg-dark">

  <!-- Navigation bar -->
  <div id="navbar-placeholder"></div>

  <!-- Add margin to top  -->
  <div class="container-add-margin"></div>

  <!-- Ticket Booking section -->
  <!-- Ticket Booking section -->
  <div class="container-fluid bg-dark mt-4">
    <div class="row justify-content-center">
      <div class="col-md-3">
        <img src="" class="img-fluid rounded movie-image" alt="Movie Image" id="movie-image">
      </div>
      <div class="col-md-5">
        <div class="card bg-dark text-white">
          <div class="card-body">
            <h2 class="text-center mb-4 main-c-t">Book Tickets</h2>

            <form id="booking-form" action="php/booking.php" method="post">
              <div class="form-group mb-4">
                <label for="movie">Movie Name:</label>
                <select class="form-control" id="movie" name="movie">
                  <!-- Movie titles will be dynamically updated based on the data from the server -->
                </select>
              </div>
              <div class="form-group mb-4">
                <label for="showtime">Select Showtime:</label>
                <select class="form-control" id="showtime" name="showtime">
                  <!-- Showtimes will be dynamically updated based on the selected movie -->
                </select>
              </div>
              <div class="form-group">
                <label>Select Seat:</label>
                <div class="seat-selection" id="seat-selection">
                  <!-- Seat selection will be generated dynamically -->
                </div>
              </div>
              <button type="submit" class="btn btn-primary main-c-b mt-3">Confirm Booking</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- footer -->
  <div id="footer-placeholder"></div>

  <script src="js/scripts.js"></script>




    <script>
      document.addEventListener("DOMContentLoaded", function() {
        // Function to fetch movies data
        function fetchMoviesData(url) {
          return fetch(url)
            .then(response => {
              if (!response.ok) {
                throw new Error('Network response was not ok');
              }
              return response.json();
            });
        }

        // Function to fetch movies and their data
        function fetchMoviesAndData() {
          fetchMoviesData("php/getMovies.php")
            .then(data => {
              movies = data;
              updateMovies();
              fetchSeats(); // Fetch seats after movies data is available
            })
            .catch(error => console.error("Error fetching movies:", error));
        }

        // Function to fetch seats for the selected movie and showtime
        function fetchSeats() {
          var movie = document.getElementById("movie").value;
          var showtime = document.getElementById("showtime").value;

          // Make an AJAX request to fetch booked seats for the selected movie and showtime
          fetch("php/getBookedSeats.php", {
              method: "POST",
              headers: {
                "Content-Type": "application/x-www-form-urlencoded",
              },
              body: "movietitle=" + encodeURIComponent(movie) + "&showtime=" + encodeURIComponent(showtime),
            })
            .then(response => response.json())
            .then(data => {
              console.log("Booked seats data:", data);

              // Generate seats dynamically based on the booked seats data
              generateSeats(data);
            })
            .catch(error => console.error("Error fetching seats:", error));
        }

        // Function to update the movie select dropdown with the selected movie title
        function updateMovies() {
          var movieSelect = document.getElementById("movie");
          var urlParams = new URLSearchParams(window.location.search);
          var selectedMovieTitle = urlParams.get('movie');

          // Clear previous options
          movieSelect.innerHTML = "";

          // Populate the movie select dropdown with the selected movie title
          var option = document.createElement("option");
          option.value = selectedMovieTitle;
          option.textContent = selectedMovieTitle;
          movieSelect.appendChild(option);

          // Update other movie details based on the selected movie
          updateShowtimes(selectedMovieTitle);
        }

        // Function to update the showtime select dropdown with the available showtimes for the selected movie
        function updateShowtimes(selectedMovieTitle) {
          var selectedMovie = movies.find(movie => movie.title === selectedMovieTitle);

          var showtimeSelect = document.getElementById("showtime");
          showtimeSelect.innerHTML = ""; // Clear previous options

          // Populate the showtime select dropdown with the available showtimes for the selected movie
          selectedMovie.showtimes.forEach(showtime => {
            var option = document.createElement("option");
            option.value = showtime;
            option.textContent = showtime;
            showtimeSelect.appendChild(option);
          });

          // Fetch seats for the selected movie and showtime
          fetchSeats();

          // Update the movie image based on the selected movie
          var movieImage = document.getElementById("movie-image");
          movieImage.src = "images/posters/" + selectedMovie.id + ".jpg";
        }

        // Function to generate seat selection dynamically based on the booked seats data
        function generateSeats(bookedSeats) {
          // Clear the seat selection container
          var seatSelectionContainer = document.getElementById("seat-selection");
          seatSelectionContainer.innerHTML = "";

          // Define the rows and seats per row
          var rows = ['A', 'B', 'C', 'D'];
          var seatsPerRow = 10;

          // Generate seat selection dynamically
          rows.forEach(row => {
            var rowElement = document.createElement('div');
            rowElement.classList.add('row', 'mb-2');

            for (var i = 1; i <= seatsPerRow; i++) {
              var seatNumber = row + i;
              var isBooked = bookedSeats.includes(seatNumber);

              var colElement = document.createElement('div');
              colElement.classList.add('col-sm-1');

              var inputElement = document.createElement('input');
              inputElement.type = 'checkbox';
              inputElement.classList.add('form-check-input');
              inputElement.name = 'seats[]';
              inputElement.value = seatNumber;
              inputElement.id = 'seat-' + seatNumber;
              inputElement.disabled = isBooked;

              var labelElement = document.createElement('label');
              labelElement.classList.add('form-check-label', isBooked ? 'booked-seat' : 'available-seat');
              labelElement.setAttribute('for', 'seat-' + seatNumber);
              labelElement.textContent = seatNumber;

              colElement.appendChild(inputElement);
              colElement.appendChild(labelElement);
              rowElement.appendChild(colElement);
            }

            seatSelectionContainer.appendChild(rowElement);
          });
        }

        // Function to validate if seats are selected
        function validateSeatsSelected() {
          var selectedSeats = document.querySelectorAll('input[name="seats[]"]:checked');
          return selectedSeats.length > 0;
        }

        // Fetch movies and their data
        fetchMoviesAndData();

        // Add event listener to the showtime select element to update seats when showtime changes
        document.getElementById("showtime").addEventListener("change", function() {
          fetchSeats();
        });

        // Add event listener to the booking form to handle form submission
        document.getElementById("booking-form").addEventListener("submit", function(event) {
          // Prevent the form from submitting by default
          event.preventDefault();

          // Validate if seats are selected
          if (!validateSeatsSelected()) {
            alert("Please select at least one seat.");
            return; // Prevent further execution
          }

          // If seats are selected, continue with form submission
          this.submit();
        });
      });
    </script>


  </body>

  </html>




</body>

</html>