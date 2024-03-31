<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Additional CSS styles */
        .small-textbox {
            width: 200px;
            /* Adjust the width as needed */
        }
    </style>
</head>

<body class="bg-dark">



    <div class="container mt-5 justify-content-center">
        <h2 class="text-white ">Cineplex Cinema</h2>
        <?php
        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "cineplexdb";

        // Create database connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the ID of the last movie
        $lastIdQuery = "SELECT id FROM movies ORDER BY id DESC LIMIT 1";
        $result = $conn->query($lastIdQuery);
        $lastId = 0;
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastId = $row["id"];
        }
        $nextId = $lastId + 1;
        ?>
        <p>Movie ID: <?php echo $nextId; ?></p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="mt-4 mb-4">
            <input type="hidden" name="next_id" value="<?php echo $nextId; ?>">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-6">
                        <div class="form-group mb-4">
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Title">
                        </div>

                        <div class="form-group mb-3">
                            <label for="moredetails">More Details:</label>
                            <textarea id="moredetails" name="moredetails" class="form-control" placeholder="More Details"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="timings">Timings:</label>
                            <input type="text" id="timings" name="timings" class="form-control" placeholder="Timings">
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status:</label>
                            <input type="text" id="status" name="status" class="form-control" placeholder="Status">
                        </div>

                        <div class="form-group mb-3">
                            <label for="releasedate">Release Date:</label>
                            <input type="date" id="releasedate" name="releasedate" class="form-control" placeholder="Release Date">
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Select Image:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <input type="submit" value="Submit" class="form-control btn btn-primary btn-block main-c-b">
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <?php

        // Check if the form is submitted and the image file is uploaded
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["image"])) {
            // Retrieve form data
            $title = $_POST["title"];
            $moredetails = $_POST["moredetails"];
            $timings = $_POST["timings"];
            $status = $_POST["status"];
            $releasedate = $_POST["releasedate"];

            // Get the next available movie ID
            $lastIdQuery = "SELECT id FROM movies ORDER BY id DESC LIMIT 1";
            $result = $conn->query($lastIdQuery);
            $nextId = 1;
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nextId = $row["id"] + 1;
            }

            // Get the extension of the uploaded image file
            $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

            // Generate the image filename using the next movie ID and extension
            $newFileName = $nextId . "." . $extension;

            // Set the target directory for storing the image
            $targetDirectory = "images/posters/";

            // Set the target file path
            $targetFilePath = $targetDirectory . $newFileName;

            // Move the uploaded image to the target directory with the new filename
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Prepare and execute SQL query to insert movie data
                $stmt = $conn->prepare("INSERT INTO movies (id, title, moredetails, timings, status, releasedate) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssss", $nextId, $title, $moredetails, $timings, $status, $releasedate);
                $stmt->execute();

                // Close the prepared statement
                $stmt->close();

                // Show alert upon successful addition
                echo "<script>alert('Movie added successfully.');</script>";
            } else {
                echo "Failed to upload image.";
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>


    <script src="js/scripts.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>