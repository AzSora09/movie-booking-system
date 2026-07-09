<?php
// Start the session on all admin pages for authentication and user tracking
session_start();

// Database connection shared by all admin pages
$conn = mysqli_connect('localhost', 'root', '', 'movie-booking-system');

// Admin Page validation to keep users out
if (!isset($_SESSION["user_name"])) {

    alertjs("Please log in to access the admin panel.");
    redirect("../login.php");

}

elseif ($_SESSION["user_role"] !== "admin") {

    alertjs("Only administrators are allowed to access this page.");
    redirect("../index.php");

}


// Helper to show a browser alert with the given message
function alertjs($content)
{
    echo "<script> alert(" . json_encode($content) . ") </script>";
}

function redirect($url)
{
    echo "<script> window.location.href = " . json_encode($url) . " </script>";
    exit;
}

function head($title)
{
?>
    <title><?php echo $title; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <!-- JQuery -->
    <script src="../jquery-3.7.1.js"></script>
<?php
}
?>

<?php
function navbar()
{ ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">

                <a class="navbar-brand fw-bold" href="./index.php">
                    ShowRadar <span class="fw-light">Admin</span>
                </a>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="collapsibleNavId">

                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">Dashboard</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                Movies
                            </a>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="./add-movie.php">Add Movie</a>
                                <a class="dropdown-item" href="./view-movie.php">View Movies</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                Cinemas
                            </a>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="./add-cinema.php">Add Cinema</a>
                                <a class="dropdown-item" href="./view-cinema.php">View Cinemas</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                Schedules
                            </a>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="./add-schedules.php">Add Schedule</a>
                                <a class="dropdown-item" href="./view-schedules.php">View Schedules</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./view-tickets.php">Tickets</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./view-reviews.php">Reviews</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./view-users.php">Users</a>
                        </li>

                    </ul>

                    <ul class="navbar-nav">

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <?= $_SESSION["user_name"]; ?>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">

                                <a class="dropdown-item" href="../index.php">
                                    Back to Main Website
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item text-danger" href="../logout.php">
                                    Log Out
                                </a>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>
        </nav>
    </header>
<?php } ?>



<?php
function imgverif($file, $prefix)
{
    // Validate uploaded image type and move it to the shared images folder
    $imgtmp = $file["tmp_name"];
    $imgname = $file["name"];

    $exte = strtolower(pathinfo($imgname, PATHINFO_EXTENSION));

    $allowed = ["jpg", "jpeg", "png", "webp"];

    if (!in_array($exte, $allowed)) {
        return false;
    }

    if (getimagesize($imgtmp) === false) {
        return false;
    }

    $newname = uniqid($prefix . "_", true) . "." . $exte;
    $destination = "../images/" . $newname;

    if (move_uploaded_file($imgtmp, $destination)) {
        return $newname;
    }

    return false;
}

function youtubeID($input)
{
    $input = trim($input);

    // If the input is already a valid YouTube video ID, return it unchanged
    if (preg_match('/^[A-Za-z0-9_-]{11}$/', $input)) {
        return $input;
    }

    $parts = parse_url($input);

    // Normal YouTube link with v= parameter
    if (isset($parts["query"])) {
        parse_str($parts["query"], $query);

        if (isset($query["v"])) {
            return $query["v"];
        }
    }

    // Short youtu.be link format
    if (isset($parts["host"]) && $parts["host"] == "youtu.be") {
        return ltrim($parts["path"], "/");
    }

    return false;
}


function selectdata($table, $id = null)
{
    // Fetch all rows from a table or a single row when ID is provided
    global $conn;

    if ($id !== null) {
        $result = mysqli_query($conn, "Select * from $table where id = $id");
    } else {
        $result = mysqli_query($conn, "Select * from $table");
    }

    return $result;
}

function deletedata($table, $id)
{
    global $conn;

    // Delete a row from a table based on the provided ID
        mysqli_query($conn, "Delete from $table where id = $id");
}

function getvalue($table, $column, $id)
{
    global $conn;

    $query = mysqli_query($conn, "SELECT $column FROM $table WHERE id = $id");
    $row = mysqli_fetch_assoc($query);

    return $row[$column];
}

function countdata($table)
{
    global $conn;

    $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM $table");
    $row = mysqli_fetch_assoc($query);

    return $row["total"];
}
?>