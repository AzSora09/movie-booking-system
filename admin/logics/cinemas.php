<?php

// Function addcinema: Handle adding a new cinema to the database
function addcinema()
{
    global $conn;

    // Check if the form is submitted
    if (isset($_POST["submit"])) {

        // Collect cinema details from the form
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $location = mysqli_real_escape_string($conn, $_POST["location"]);

        // Insert cinema into the database
        $query = mysqli_query($conn, "INSERT INTO `cinemas`
            (`name`, `location`)
            VALUES ('$name','$location')
        ");

        // Display success message after adding the cinema
        if ($query) {
            alertjs("Cinema added successfully");
            exit;
        }
    }
}


// Function editcinema: Handle updating an existing cinema in the database
function editcinema($id)
{
    global $conn;

    // Check if the form is submitted
    if (isset($_POST["submit"])) {

        // Collect updated cinema details from the form
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $location = mysqli_real_escape_string($conn, $_POST["location"]);

        // Update cinema details in the database
        $query = mysqli_query($conn, "UPDATE `cinemas`
            SET `name`='$name',
                `location`='$location'
            WHERE `id`='$id'
        ");

        // Redirect to the cinema list after successful update
        if ($query) {
            alertjs("Cinema updated successfully");
            redirect("./view-cinema.php");
        }
    }
}

?>