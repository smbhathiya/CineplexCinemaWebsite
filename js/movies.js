fetch('php/now_showing_movies.php')
    .then(response => response.json())
    .then(movies => {
        const container = document.querySelector('.now-showing-row'); // Get the container for now showing movie cards

        // Dynamically generate movie cards
        movies.forEach(movie => {
            const colDiv = document.createElement('div');
            colDiv.className = 'col-md-3';
            colDiv.style.marginBottom = '20px';

            const cardDiv = document.createElement('div');
            cardDiv.className = 'card';

            const cardImgTopDiv = document.createElement('div');
            cardImgTopDiv.className = 'card-img-top position-relative';

            const image = document.createElement('img');
            image.src = movie.image_path;
            image.className = 'img-fluid';
            image.alt = movie.title + ' Poster';

            const movieTitleOverlayDiv = document.createElement('div');
            movieTitleOverlayDiv.className = 'movie-title-overlay';

            const title = document.createElement('h5');
            title.className = 'movie-title';
            title.textContent = movie.title;

            const moreDetailsBtn = document.createElement('a');
            moreDetailsBtn.href = movie.moredetails;
            moreDetailsBtn.className = 'btn btn-success btn-sm mt-3 mr-2 main-c-b'; // Added mr-2 for margin
            moreDetailsBtn.textContent = 'More Details';
            moreDetailsBtn.target = '_blank'; // Open link in a new tab

// Create the "Book Tickets" button
const bookTicketsBtn = document.createElement('a');

// Set the "Book Tickets" button's attributes
bookTicketsBtn.className = 'btn btn-primary btn-sm mt-3';
bookTicketsBtn.style.marginLeft = '10px';
bookTicketsBtn.textContent = 'Book Tickets';

// Check if the user is logged in
fetch('php/sessionCheck.php')
    .then(response => response.text())
    .then(data => {
        if (data.trim().startsWith('Logged in')) {

            // Set the href attribute for the "Book Tickets" button
            bookTicketsBtn.href = 'tickets.php?movie=' + encodeURIComponent(movie.title) + '&id=' + movie.id + '&timings=' + encodeURIComponent(JSON.stringify(movie.timings));
        } else {
            // If not logged in, disable the "Book Tickets" button and add a tooltip
            bookTicketsBtn.href = '#'; // Set a placeholder href
            bookTicketsBtn.setAttribute('data-toggle', 'tooltip'); // Add tooltip attribute
            bookTicketsBtn.setAttribute('title', 'You must be logged in to book tickets'); // Add tooltip text

            // Add click event listener to handle button clicks
            bookTicketsBtn.addEventListener('click', function(event) {
                // Prevent the default behavior (i.e., following the href attribute)
                event.preventDefault();
                
                // Prompt the user to log in
                const result = confirm('You must be logged in to book tickets. Do you want to log in now?');
                
                // If the user chooses to log in, redirect to the login page
                if (result) {
                    window.location.href = 'login.html';
                }
            });
        }
    })
    .catch(error => console.error('Error checking login status:', error));





            // Append the elements to the card
            movieTitleOverlayDiv.appendChild(title);
            movieTitleOverlayDiv.appendChild(moreDetailsBtn);
            movieTitleOverlayDiv.appendChild(bookTicketsBtn);
            cardImgTopDiv.appendChild(image);
            cardImgTopDiv.appendChild(movieTitleOverlayDiv);
            cardDiv.appendChild(cardImgTopDiv);
            colDiv.appendChild(cardDiv);
            container.appendChild(colDiv);
        });
    })
    .catch(error => console.error('Error fetching now showing movie data:', error));




//---------------------------------------------------------------------------------------------------------------------------------------------------------
fetch('php/upcoming_movies.php') // Adjust the path as needed
    .then(response => response.json())
    .then(upcomingMovies => {
        const container = document.querySelector('.upcoming-movies-row'); // Get the container for upcoming movie cards

        // Dynamically generate upcoming movie cards
        upcomingMovies.forEach(movie => {
            const colDiv = document.createElement('div');
            colDiv.className = 'col-md-3';
            colDiv.style.marginBottom = '20px'; 

            const cardDiv = document.createElement('div');
            cardDiv.className = 'card';

            const cardImgTopDiv = document.createElement('div');
            cardImgTopDiv.className = 'card-img-top position-relative';

            const image = document.createElement('img');
            image.src = movie.image_path;
            image.className = 'img-fluid';
            image.alt = movie.title + ' Poster';

            const movieTitleOverlayDiv = document.createElement('div');
            movieTitleOverlayDiv.className = 'movie-title-overlay';

            const title = document.createElement('h5');
            title.className = 'movie-title';
            title.textContent = movie.title;

            const releaseDate = document.createElement('h6'); // Create small element for release date
            releaseDate.textContent = 'From: ' + movie.releasedate;
            releaseDate.style.color = 'yellow'; // Apply yellow color
            title.appendChild(document.createElement('br')); // Add line break
            title.appendChild(releaseDate); // Append release date to title

            const moreDetailsBtn = document.createElement('a');
            moreDetailsBtn.href = movie.moredetails;
            moreDetailsBtn.className = 'btn btn-success main-c-b btn-sm mt-3';
            moreDetailsBtn.textContent = 'More Details';
            moreDetailsBtn.target = '_blank'; // Open link in a new tab

            // Append elements to the card
            movieTitleOverlayDiv.appendChild(title);
            movieTitleOverlayDiv.appendChild(moreDetailsBtn);
            cardImgTopDiv.appendChild(image);
            cardImgTopDiv.appendChild(movieTitleOverlayDiv);
            cardDiv.appendChild(cardImgTopDiv);
            colDiv.appendChild(cardDiv);
            container.appendChild(colDiv);
        });
    })
    .catch(error => console.error('Error fetching upcoming movie data:', error));
