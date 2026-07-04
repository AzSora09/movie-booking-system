<?php
// Handle the add cinema form submission and insert a new cinema record
function addcinema()
{
    global $conn;
    if (isset($_POST["submit"])) {

        // Sanitize form inputs for cinema name and location
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $location = mysqli_real_escape_string($conn, $_POST["location"]);

        $query = mysqli_query($conn, "INSERT INTO `cinemas`
            (`name`, `location`)
            VALUES ('$name','$location')
            ");

        if ($query) {
            alertjs("Cinema added successfully");
            exit;
        }
    }
}

function editcinema($id)
{
    global $conn;
    if (isset($_POST["submit"])) {

        // Sanitize form inputs for cinema name and location
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $location = mysqli_real_escape_string($conn, $_POST["location"]);

        $query = mysqli_query($conn, "UPDATE `cinemas`
            SET `name`='$name', `location`='$location'
            WHERE `id`='$id'
            ");

        if ($query) {
            alertjs("Cinema updated successfully");
            redirect("./view-cinema.php");
        }
    }
}

?>