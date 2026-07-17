<?php

global $conn;


// Check if user is logged in before booking tickets
if (!isset($_SESSION["user_name"])) {

    alertjs("Please login to book tickets.");
    redirect("./login.php");

}



// Check if schedule id exists
if (!isset($_GET["schedule"])) {

    redirect("./movies.php");

}


$schedule_id = $_GET["schedule"];


// Fetch schedule details
$schedule_query = mysqli_query(
    $conn,
    "SELECT *
     FROM schedules
     WHERE id = $schedule_id"
);



if (mysqli_num_rows($schedule_query) == 0) {

    redirect("./movies.php");

}


$schedule = mysqli_fetch_assoc($schedule_query);




// Fetch movie details from schedule
$movie = mysqli_fetch_assoc(

    mysqli_query(
        $conn,
        "SELECT *
         FROM movies
         WHERE id = " . $schedule["movie_id"]
    )

);




// Fetch cinema details from schedule
$cinema = mysqli_fetch_assoc(

    mysqli_query(
        $conn,
        "SELECT *
         FROM cinemas
         WHERE id = " . $schedule["cinema_id"]
    )

);





// Handle booking submission
if (isset($_POST["book"])) {


    // Collect booking details
    $class_type = $_POST["class_type"];

    $tkt_amount = $_POST["tkt_amount"];

    $children_amount = $_POST["children_amount"];




    // Validate ticket amounts
    if ($tkt_amount <= 0) {

        alertjs("Enter ticket quantity.");

    } elseif ($children_amount > $tkt_amount) {

        alertjs("Children tickets cannot exceed total tickets.");

    } else {


        // Get ticket price based on selected class
        if ($class_type == "Box") {

            $price = $schedule["box_price"];

        } elseif ($class_type == "Gold") {

            $price = $schedule["gold_price"];

        } elseif ($class_type == "Platinum") {

            $price = $schedule["platinum_price"];

        } else {

            alertjs("Invalid class selected.");
            exit;

        }





        // Calculate total price with child concession
        $adult_amount = $tkt_amount - $children_amount;


        $total_price =
            ($adult_amount * $price)
            +
            ($children_amount * ($price / 2));






        // Get user id from logged in user's name
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







        // Insert booking details into tickets table
        mysqli_query(
            $conn,
            "INSERT INTO tickets

            (
                user_id,
                schedule_id,
                class_type,
                tkt_amount,
                children_amount,
                total_price,
                tkt_date_time
            )


            VALUES

            (
                $user_id,
                $schedule_id,
                '$class_type',
                $tkt_amount,
                $children_amount,
                $total_price,
                NOW()
            )"
        );



        alertjs("Booking successful!");

        redirect("./my-bookings.php");


    }

}


?>