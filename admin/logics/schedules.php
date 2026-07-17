<?php

// Function addschedule: Handle adding a new movie schedule to the database
function addschedule()
{
    global $conn;

    // Check if the form is submitted
    if (isset($_POST['submit'])) {

        // Collect schedule details from the form
        $movie_id = $_POST['movie'];
        $cinema_id = $_POST['cinema'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $b_price = $_POST['b_price'];
        $g_price = $_POST['g_price'];
        $p_price = $_POST['p_price'];

        // Insert schedule into the database
        $query = mysqli_query($conn, "INSERT INTO schedules
        (`movie_id`, `cinema_id`, `date`, `time`, `box_price`, `gold_price`, `platinum_price`)
        VALUES ('$movie_id', '$cinema_id', '$date', '$time', '$b_price', '$g_price', '$p_price')");

        // Display success message after adding the schedule
        if ($query) {

            alertjs("Schedule added successfully");
            redirect("./add-schedules.php");

        } else {

            alertjs("Failed to add schedule. Please try again.");

        }
    }
}


// Function editschedule: Handle updating an existing movie schedule in the database
function editschedule()
{
    global $conn;

    // Check if the form is submitted
    if (isset($_POST['submit'])) {

        // Collect updated schedule details from the form
        $schedule_id = $_GET['id'];
        $movie_id = $_POST['movie'];
        $cinema_id = $_POST['cinema'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $b_price = $_POST['b_price'];
        $g_price = $_POST['g_price'];
        $p_price = $_POST['p_price'];

        // Update schedule details in the database
        $query = mysqli_query($conn, "UPDATE schedules SET
            movie_id='$movie_id',
            cinema_id='$cinema_id',
            date='$date',
            time='$time',
            box_price='$b_price',
            gold_price='$g_price',
            platinum_price='$p_price'
            WHERE id='$schedule_id'");

        // Redirect to the schedule list after successful update
        if ($query) {

            alertjs("Schedule updated successfully");
            redirect("./view-schedules.php");

        } else {

            alertjs("Failed to update schedule. Please try again.");

        }
    }
}

?>