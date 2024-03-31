function generateCarouselItems(imagePaths) {
    var carouselInner = document.getElementById("carouselInner");
    var html = "";
  
    imagePaths.forEach(function(imagePath, index) {
      var isActive = (index === 0) ? "active" : ""; // Set first image as active
  
      html += `
      <div class="carousel-item ${isActive}">
        <img src="${imagePath}" class="d-block" alt="Slide ${index + 1}">
        <div class="background-image" style="background-image: url('${imagePath}');"></div>
      </div>
      `;
    });
  
    carouselInner.innerHTML = html; 
  }
  
  // Call the function to fetch image paths and generate carousel items
  window.onload = function() {
    // AJAX request to fetch image paths
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var imagePaths = JSON.parse(xhr.responseText);
          generateCarouselItems(imagePaths);
        } else {
          console.error("Failed to fetch image paths");
        }
      }
    };
    xhr.open("GET", "php/fetch_images.php", true);
    xhr.send();
  };
  