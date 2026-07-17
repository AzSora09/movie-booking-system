<?php
// Handle the add movie form submission and insert a new movie record
function addmovie()
{
    global $conn;
    if (isset($_POST["submit"])) {
        // Collect movie form values and clean them before saving

        // Sanitize and collect form inputs
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
        $genre = mysqli_real_escape_string($conn, $_POST["genre"]);
        $dur = $_POST["dur_hr"] . " hr " . $_POST["dur_min"] . " min";
        $lang = mysqli_real_escape_string($conn, $_POST["lang"]);
        $age = $_POST["age"];
        $image = imgverif($_FILES["poster"], "movie");
        $trailer = mysqli_real_escape_string($conn, youtubeID($_POST["trailer"]));

        if ($image) {
            // Insert new movie into the database with uploaded poster and trailer ID
            mysqli_query($conn, "INSERT INTO `movies`
            (`title`, `description`, `genre`, `duration`, `language`, `age_rating`, `poster`, `trailer`)
            VALUES ('$name','$desc','$genre','$dur','$lang','$age','$image','$trailer')
            ");

            alertjs("Movie added successfully");
            exit;
        } else {
            alertjs("Invalid Image");
        }
    }
}

function editmovie($id)
{
    global $conn;
    if (isset($_POST["submit"])) {
        // Update an existing movie record with posted values

        // Sanitize and collect form inputs
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
        $genre = mysqli_real_escape_string($conn, $_POST["genre"]);
        $dur = $_POST["dur_hr"] . " hr " . $_POST["dur_min"] . " min";
        $lang = mysqli_real_escape_string($conn, $_POST["lang"]);
        $age = $_POST["age"];
        $trailer = mysqli_real_escape_string($conn, youtubeID($_POST["trailer"]));

        // Check if a new poster image is uploaded
        if (!empty($_FILES["poster"]["name"])) {
            $image = imgverif($_FILES["poster"], "movie");
            if ($image) {
                // Update movie with new poster
                mysqli_query($conn, "UPDATE `movies`
                SET `title`='$name', `description`='$desc', `genre`='$genre', `duration`='$dur', `language`='$lang', `age_rating`='$age', `poster`='$image', `trailer`='$trailer'
                WHERE `id`='$id'
                ");
            } else {
                alertjs("Invalid Image");
                return;
            }
        } else {
            // Update movie without changing the poster
            mysqli_query($conn, "UPDATE `movies`
            SET `title`='$name', `description`='$desc', `genre`='$genre', `duration`='$dur', `language`='$lang', `age_rating`='$age', `trailer`='$trailer'
            WHERE `id`='$id'
            ");
        }

        alertjs("Movie updated successfully");
        redirect("./view-movie.php");
    }
}

?>