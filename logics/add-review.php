<?php
// Handles adding a review: checks login, validates input, inserts into DB
global $conn;

if (!isset($_SESSION["user_name"])) {

    alertjs("Please login to add a review.");
    redirect("./login.php");
}



// Ensure a movie id was provided in the URL
if (!isset($_GET["movie"])) {

    redirect("./movies.php");
}


$movie_id = $_GET["movie"];




// Fetch movie

$movie_query = mysqli_query(
    $conn,
    "SELECT *
     FROM movies
     WHERE id = $movie_id"
);



if (mysqli_num_rows($movie_query) == 0) {

    redirect("./movies.php");
}


$movie = mysqli_fetch_assoc($movie_query);





// Submit review
// Handle form submission for a new review
if (isset($_POST["submit"])) {


    $rating = $_POST["rating"];

    $comment = $_POST["comment"];




    if ($rating < 1 || $rating > 5) {

        alertjs("Please select a rating.");
    } elseif (empty($comment)) {

        alertjs("Please write a comment.");
    } else {



        // Get user id

        $name = explode(" ", $_SESSION["user_name"], 2);


        $first_name = $name[0];

        $last_name = $name[1];



        $user_query = mysqli_query(
            $conn,
            "SELECT id
             FROM accounts
             WHERE first_name='$first_name'
             AND last_name='$last_name'"
        );


        $user = mysqli_fetch_assoc($user_query);


        $user_id = $user["id"];





        // Insert review

        $check_review = mysqli_query(
            $conn,
            "SELECT *
     FROM reviews
     WHERE user_id = $user_id
     AND movie_id = $movie_id"
        );


        if (mysqli_num_rows($check_review) > 0) {

            alertjs("You have already reviewed this movie.");
        } else {

            mysqli_query(
                $conn,
                "INSERT INTO reviews
            (
                user_id,
                movie_id,
                rating,
                comment,
                review_datetime
            )

            VALUES

            (
                $user_id,
                $movie_id,
                $rating,
                '$comment',
                NOW()
            )"
            );



            alertjs("Review added successfully.");

            redirect("./movie.php?id=$movie_id");
        }
    }
}
