<?php
function addmovie()
{
    global $conn;
    if (isset($_POST["submit"])) {

        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
        $genre = mysqli_real_escape_string($conn, $_POST["genre"]);
        $dur = $_POST["dur_hr"] . " hr " . $_POST["dur_min"] . " min";
        $lang = mysqli_real_escape_string($conn, $_POST["lang"]);
        $age = $_POST["age"];
        $image = imgverif($_FILES["poster"], "movie");
        $trailer = mysqli_real_escape_string($conn, youtubeID($_POST["trailer"]));


        if($image) {
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
?>