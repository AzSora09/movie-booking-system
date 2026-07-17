<?php
global $conn;

// Validate cinema id parameter; redirect to list when missing
if (!isset($_GET["id"])) {
    redirect("./cinemas.php");
}


$cinema_id = $_GET["id"];



$cinema_query = selectdata("cinemas", $cinema_id);


if (mysqli_num_rows($cinema_query) == 0) {
    redirect("./cinemas.php");
}


$cinema = mysqli_fetch_assoc($cinema_query);



// Fetch schedules for this cinema (grouped by movie then date/time)
$schedule_query = mysqli_query(
    $conn,
    "SELECT *
     FROM schedules
     WHERE cinema_id = $cinema_id
     ORDER BY movie_id, date, time"
);

?>