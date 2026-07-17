<?php

global $conn;


// Check if movie id is provided
if (!isset($_GET["id"])) {

    redirect("./movies.php");

}


$movie_id = $_GET["id"];




// Fetch movie details
$movie_query = selectdata("movies", $movie_id);



if (mysqli_num_rows($movie_query) == 0) {

    redirect("./movies.php");

}


$movie = mysqli_fetch_assoc($movie_query);





// Calculate average movie rating
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







// Fetch schedules available for this movie
$schedule_query = mysqli_query(
    $conn,
    "SELECT * 
     FROM schedules 
     WHERE movie_id = $movie_id
     ORDER BY date, time"
);







// Fetch reviews for this movie
$review_query = mysqli_query(
    $conn,
    "SELECT * 
     FROM reviews 
     WHERE movie_id = $movie_id
     ORDER BY review_datetime DESC"
);


?>