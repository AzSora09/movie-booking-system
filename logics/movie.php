<?php
global $conn;

if (!isset($_GET["id"])) {
    redirect("./movies.php");
}

$movie_id = $_GET["id"];

$movie_query = selectdata("movies", $movie_id);

if (mysqli_num_rows($movie_query) == 0) {
    redirect("./movies.php");
}

$movie = mysqli_fetch_assoc($movie_query);


// Average rating for display (rounded to 1 decimal)
$rating_query = mysqli_query(
    $conn,
    "SELECT AVG(rating) AS average 
     FROM reviews 
     WHERE movie_id = $movie_id"
);

$rating_data = mysqli_fetch_assoc($rating_query);

$average_rating = $rating_data["average"] 
    ? number_format($rating_data["average"], 1)
    : "No ratings";


// Fetch schedules for this movie (ordered by date/time)
$schedule_query = mysqli_query(
    $conn,
    "SELECT * 
     FROM schedules 
     WHERE movie_id = $movie_id
     ORDER BY date, time"
);


// Fetch reviews (most recent first)
$review_query = mysqli_query(
    $conn,
    "SELECT * 
     FROM reviews 
     WHERE movie_id = $movie_id
     ORDER BY review_datetime DESC"
);

?>