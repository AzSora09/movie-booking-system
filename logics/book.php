<?php
global $conn;

// Check login

if (!isset($_SESSION["user_name"])) {

    alertjs("Please login to book tickets.");
    redirect("./login.php");

}



// Check schedule

if (!isset($_GET["schedule"])) {

    redirect("./movies.php");

}


$schedule_id = $_GET["schedule"];




// Fetch schedule

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





// Fetch movie

$movie = mysqli_fetch_assoc(

    mysqli_query(
        $conn,
        "SELECT *
         FROM movies
         WHERE id = ".$schedule["movie_id"]
    )

);





// Fetch cinema

$cinema = mysqli_fetch_assoc(

    mysqli_query(
        $conn,
        "SELECT *
         FROM cinemas
         WHERE id = ".$schedule["cinema_id"]
    )

);





// Booking submit

if (isset($_POST["book"])) {


    $class_type = $_POST["class_type"];

    $tkt_amount = $_POST["tkt_amount"];

    $children_amount = $_POST["children_amount"];




    if ($tkt_amount <= 0) {

        alertjs("Enter ticket quantity.");

    }


    elseif ($children_amount > $tkt_amount) {

        alertjs("Children tickets cannot exceed total tickets.");

    }


    else {



        // Get price based on class

        if ($class_type == "Box") {

            $price = $schedule["box_price"];

        }

        elseif ($class_type == "Gold") {

            $price = $schedule["gold_price"];

        }

        elseif ($class_type == "Platinum") {

            $price = $schedule["platinum_price"];

        }

        else {

            alertjs("Invalid class selected.");
            exit;

        }





        // Calculate final price

        $adult_amount = $tkt_amount - $children_amount;


        // 50% concession

        $total_price =
            ($adult_amount * $price)
            +
            ($children_amount * ($price / 2));






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






        // Insert ticket

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