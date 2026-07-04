<?php
function addcinema()
{
    global $conn;
    if (isset($_POST["submit"])) {

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

?>