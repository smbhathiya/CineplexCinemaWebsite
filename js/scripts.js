//---------------------------------------------------------------------------------------------------------------------------------------------------
// navbar-loader.js
document.addEventListener("DOMContentLoaded", function() {
    var navbarPlaceholder = document.getElementById("navbar-placeholder");

    if (navbarPlaceholder) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', './files/navbar.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                navbarPlaceholder.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
});

//---------------------------------------------------------------------------------------------------------------------------------------------------
//footer-loader.js
document.addEventListener("DOMContentLoaded", function() {
    var footerPlaceholder = document.getElementById("footer-placeholder");

    if (footerPlaceholder) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', './files/footer.html', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                footerPlaceholder.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
});

//---------------------------------------------------------------------------------------------------------------------------------------------------
//slide-show-loader.js
document.addEventListener("DOMContentLoaded", function() {
    var footerPlaceholder = document.getElementById("slide-show");

    if (footerPlaceholder) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', './files/slide-show.html', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                footerPlaceholder.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
});

//---------------------------------------------------------------------------------------------------------------------------------------------------
// Resize images based on the container size
window.addEventListener('load', function() {
  const carouselContainer = document.querySelector('.carousel-container');
  const images = document.querySelectorAll('.carousel-item img');

  function resizeImages() {
      images.forEach(image => {
          const aspectRatio = image.naturalWidth / image.naturalHeight;
          const containerWidth = carouselContainer.offsetWidth;
          const containerHeight = carouselContainer.offsetHeight;

          if (aspectRatio > 1) {
              image.style.width = containerWidth + 'px';
              image.style.height = containerWidth / aspectRatio + 'px';
          } else {
              image.style.height = containerHeight + 'px';
              image.style.width = containerHeight * aspectRatio + 'px';
          }
      });
  }


  window.addEventListener('resize', resizeImages);

  resizeImages();
});


  
  // Call updateShowtimes when the page loads to initialize showtimes for the default movie
  window.onload = function() {
    // updateShowtimes();
    // Retrieve movie parameter from URL if available and set the selected movie
    const urlParams = new URLSearchParams(window.location.search);
    const movieParam = urlParams.get('movie');
    if (movieParam) {
        const movieSelect = document.getElementById('movie');
        movieSelect.value = movieParam;
        // Trigger change event to update showtimes and seats
        movieSelect.dispatchEvent(new Event('change'));
    }
  };
  


//---------------------------------------------------------------------------------------------------------------------------------------------------------
// JavaScript code to handle search functionality
document.addEventListener("DOMContentLoaded", function () {
    const searchForms = document.querySelectorAll(".search-form"); // Select all search forms

    searchForms.forEach(searchForm => {
        searchForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission behavior

            // Get the search query from the form input
            const searchQuery = searchForm.querySelector(".search-input").value.trim();

            // Redirect to the search page with the search query as a URL parameter
            window.location.href = `search.html?search=${encodeURIComponent(searchQuery)}`;
        });
    });
});


function confirmSignOut() {
    var answer = confirm("Are you sure you want to sign out?");
    if (answer) {
      window.location.href = "php/logout.php";
    }
  }


// function showAlert() {
//     alert("Please log in to book seats.");
//   }

  function showAlert() {
    var confirmation = confirm("Please log in to book seats. Do you want to proceed to login?");
    if (confirmation == true) {
      window.location.replace("login.html"); // Redirect if user clicks "OK"
    } else {
      // Do nothing or redirect to another page if desired
    }
  }

  // Check if user is logged in (You can replace this with your own login status check logic)
const loggedIn = false; // Example: Assume the user is not logged in

// Get the reference to the Showtime link
const showtimesLink = document.getElementById('showtimesLink');

// Set the href attribute based on login status
if (loggedIn) {
    showtimesLink.href = 'showtimes.php';
} else {
    showtimesLink.href = '#';
    showtimesLink.onclick = showAlert; 
}

