<div class="container-fluid p-0">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand" href="index.html">
        <img src="./images/logo-100.png" alt="Cinema Hall Logo" id="logo">
      </a>

      <!-- Toggler button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <?php session_start(); ?>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
              <a class="nav-link" href="showtimes.php">Tickets Booking</a>
            <?php else : ?>
              <a class="nav-link" href="#" onclick="showAlert()">Tickets Booking</a>
            <?php endif; ?>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact us</a>
          </li>
          <?php
          if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo
            '<li class="nav-item">
                      <a class="nav-link" href="#" onclick="confirmSignOut()">Sign out</a>
                      </li>

                      <li class="nav-item">
                      <a class="nav-link" href="profile.php" style="color: #dc143c;">Profile</a>
                      </li>';
          } else {
            echo '<li class="nav-item">
                        <a class="nav-link" href="login.html">Sign in</a>
                      </li>';
          }
          ?>
        </ul>


        <!-- Search form -->
        <form class="search-form d-flex justify-content-end" action="php/search.php" method="GET">
          <input class="form-control me-2 search-input" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-primary custom-btn" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</div>