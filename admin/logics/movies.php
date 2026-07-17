<?php

// Function addmovie: Handle adding a new movie to the database
function addmovie()
{
    global $conn;

    // Check if the form is submitted
    if (isset($_POST["submit"])) {

        // Collect movie details from the form
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
        $genre = mysqli_real_escape_string($conn, $_POST["genre"]);
        $dur = $_POST["dur_hr"] . " hr " . $_POST["dur_min"] . " min";
        $lang = mysqli_real_escape_string($conn, $_POST["lang"]);
        $age = $_POST["age"];
        $image = imgverif($_FILES["poster"], "movie");
        $trailer = mysqli_real_escape_string($conn, youtubeID($_POST["trailer"]));

        // Check if the uploaded poster is valid
        if ($image) {

            // Insert movie into the database
            mysqli_query($conn, "INSERT INTO `movies`
            (`title`, `description`, `genre`, `duration`, `language`, `age_rating`, `poster`, `trailer`)
            VALUES ('$name','$desc','$genre','$dur','$lang','$age','$image','$trailer')
            ");

            // Display success message after adding the movie
            alertjs("Movie added successfully");
            exit;

        } else {

            alertjs("Invalid Image");

        }
    }
}


// Function editmovie: Handle updating an existing movie in the database
function editmovie($id)
{
    global $conn;

    // Check if the form is submitted
    if (isset($_POST["submit"])) {

        // Collect updated movie details from the form
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
        $genre = mysqli_real_escape_string($conn, $_POST["genre"]);
        $dur = $_POST["dur_hr"] . " hr " . $_POST["dur_min"] . " min";
        $lang = mysqli_real_escape_string($conn, $_POST["lang"]);
        $age = $_POST["age"];
        $trailer = mysqli_real_escape_string($conn, youtubeID($_POST["trailer"]));

        // Check if a new poster is uploaded
        if (!empty($_FILES["poster"]["name"])) {

            $image = imgverif($_FILES["poster"], "movie");

            // Check if the uploaded poster is valid
            if ($image) {

                // Update movie details with the new poster
                mysqli_query($conn, "UPDATE `movies`
                SET `title`='$name',
                    `description`='$desc',
                    `genre`='$genre',
                    `duration`='$dur',
                    `language`='$lang',
                    `age_rating`='$age',
                    `poster`='$image',
                    `trailer`='$trailer'
                WHERE `id`='$id'
                ");

            } else {

                alertjs("Invalid Image");
                return;

            }

        } else {

            // Update movie details without changing the poster
            mysqli_query($conn, "UPDATE `movies`
            SET `title`='$name',
                `description`='$desc',
                `genre`='$genre',
                `duration`='$dur',
                `language`='$lang',
                `age_rating`='$age',
                `trailer`='$trailer'
            WHERE `id`='$id'
            ");

        }

        // Redirect to the movie list after successful update
        alertjs("Movie updated successfully");
        redirect("./view-movie.php");
    }
}

?>