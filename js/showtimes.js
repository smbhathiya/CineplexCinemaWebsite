// Define movie data as an array of objects
var movies = [
  {
    title: "Godzilla - King of Monsters",
    image: "images/01.jpg",
    timings: ["Monday - 7:00 PM", "Tuesday - 7:00 PM", "Wednesday - 7:00 PM"],
    link: "tickets.php?movie=godzilla"
  },
  {
    title: "Fantastic Beasts and Where I Can Find Them",
    image: "images/02.jpg",
    timings: ["Thursday - 6:30 PM", "Friday - 6:30 PM", "Saturday - 3:00 PM"],
    link: "tickets.php?movie=fantastic-beasts"
  },
  {
    title: "Guardians of the Galaxy Vol.3",
    image: "images/03.jpg",
    timings: ["Sunday - 5:30 PM", "Monday - 7:00 PM", "Tuesday - 7:00 PM"],
    link: "tickets.php?movie=guardians-of-the-galaxy"
  },
  {
    title: "Transformers - Rise of the Beasts",
    image: "images/04.jpg",
    timings: ["Wednesday - 8:30 PM", "Thursday - 8:30 PM", "Friday - 8:30 PM"],
    link: "tickets.php?movie=transformers-rise-of-the-beasts"
  },
  {
    title: "Aquaman and the Lost Kingdom",
    image: "images/13.jpg",
    timings: ["Saturday - 2:00 PM", "Sunday - 4:30 PM", "Monday - 8:00 PM"],
    link: "tickets.php?movie=aquaman-and-the-lost-kingdom"
  },
  {
    title: "Wonka",
    image: "images/14.jpg",
    timings: ["Thursday - 7:00 PM", "Friday - 8:00 PM", "Saturday - 5:30 PM"],
    link: "tickets.php?movie=wonka"
  },
  {
    title: "The Last Voyage of the Demeter",
    image: "images/15.jpg",
    timings: ["Monday - 6:45 PM", "Wednesday - 7:30 PM", "Friday - 9:15 PM"],
    link: "tickets.php?movie=the-last-voyage-of-the-demeter"
  },
  {
    title: "Thor: Love and Thunder",
    image: "images/16.jpg",
    timings: ["Sunday - 6:00 PM", "Tuesday - 8:45 PM", "Thursday - 7:15 PM"],
    link: "tickets.php?movie=thor-love-and-thunder"
  }
];


// Function to generate HTML for each movie
function generateMovieHTML() {
var movieContainer = document.getElementById("movieContainer");

movies.forEach(function (movie) {
  var html = `
    <div class="mb-4">
      <div class="row align-items-center">
        <div class="col-md-6 text-center">
          <img src="${movie.image}" class="img-fluid rounded movie-poster m-4" alt="${movie.title} Poster">
        </div>
        <div class="col-md-6">
          <h4 class="text-white">${movie.title}</h4>
          ${generateTimingsHTML(movie.timings)}
          <a href="tickets.php?movie=${encodeURIComponent(movie.title)}&image=${encodeURIComponent(movie.image)}&timings=${encodeURIComponent(JSON.stringify(movie.timings))}" class="btn btn-primary main-c-b mt-3">Book Ticket</a>
        </div>
      </div>
    </div>
  `;
  movieContainer.innerHTML += html;
});
}

// Function to generate HTML for movie timings
function generateTimingsHTML(timings) {
var timingsHTML = "";
timings.forEach(function (timing) {
  timingsHTML += `<p class="text-white">${timing}</p>`;
});
return timingsHTML;
}

// Call the function to generate movie HTML
generateMovieHTML();
