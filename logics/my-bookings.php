<?php

require_once "required.php";

if (!isset($_SESSION["user_name"])) {

    alertjs("Please login to view your bookings.");
    redirect("./login.php");

}


// Get current user id

$name = explode(" ", $_SESSION["user_name"], 2);

$first_name = $name[0];
$last_name = $name[1];


$user_query = mysqli_query(
    $conn,
    "SELECT id
     FROM accounts
     WHERE first_name = '$first_name'
     AND last_name = '$last_name'"
);


$user = mysqli_fetch_assoc($user_query);

$user_id = $user["id"];




// Fetch bookings

$booking_query = mysqli_query(
    $conn,

    "SELECT 
        tickets.*,

        schedules.date,
        schedules.time,

        movies.title,
        cinemas.name AS cinema_name

    FROM tickets

    INNER JOIN schedules
    ON tickets.schedule_id = schedules.id

    INNER JOIN movies
    ON schedules.movie_id = movies.id

    INNER JOIN cinemas
    ON schedules.cinema_id = cinemas.id


    WHERE tickets.user_id = $user_id

    ORDER BY tickets.tkt_date_time DESC"

);

?>