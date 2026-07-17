<?php

global $conn;


// Check if user is logged in before adding a review
if (!isset($_SESSION["user_name"])) {

    alertjs("Please login to add a review.");
    redirect("./login.php");

}


// Check if movie id exists in the URL
if (!isset($_GET["movie"])) {

    redirect("./movies.php");

}


// Get movie id from URL
$movie_id = $_GET["movie"];


// Fetch selected movie details
$movie_query = selectdata("movies", $movie_id);

// Redirect back to movies page if movie does not exist
if (mysqli_num_rows($movie_query) == 0) {

    redirect("./movies.php");

}


$movie = mysqli_fetch_assoc($movie_query);



// Handle review submission
if (isset($_POST["submit"])) {


    // Get rating and comment from form
    $rating = $_POST["rating"];
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);



    // Check review input values
    if ($rating < 1 || $rating > 5) {

        alertjs("Please select a rating.");

    } elseif (empty($comment)) {

        alertjs("Please write a comment.");

    } else {


        // Split session username to find the account
        $name = explode(" ", $_SESSION["user_name"], 2);


        $first_name = $name[0];
        $last_name = $name[1];



        // Get user id using logged in user's name
        $user_query = mysqli_query(
            $conn,
            "SELECT id
             FROM accounts
             WHERE first_name='$first_name'
             AND last_name='$last_name'"
        );


        $user = mysqli_fetch_assoc($user_query);

        $user_id = $user["id"];




        // Check if user already reviewed this movie
        $check_review = mysqli_query(
            $conn,
            "SELECT *
             FROM reviews
             WHERE user_id = $user_id
             AND movie_id = $movie_id"
        );


        // Don't allow user to add a review if they have already reviewed this movie
        if (mysqli_num_rows($check_review) > 0) {

            alertjs("You have already reviewed this movie.");

        } else {


            // Insert new review into database
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

?>