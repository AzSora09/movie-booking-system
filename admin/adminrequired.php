<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'movie-booking-system');

function alertjs($content)
{
    echo "<script> alert(" . json_encode($content) . ") </script>";
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
        <nav
            class="navbar navbar-expand-sm navbar-light bg-danger">
            <div class="container">
                <a class="navbar-brand" href="./index.php">ShowRadar Admin</a>
                <button
                    class="navbar-toggler d-lg-none order-first"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="d-flex">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0 order-first order-md-last">
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                data-bs-toggle="dropdown"
                                href="#"
                                role="button"
                                aria-haspopup="true"
                                aria-expanded="false"><?php echo $_SESSION["user_name"]; ?></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>
                        </li>
                    </ul>

                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="../index.php" aria-current="page">Back to Main Website</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./index.php">Dashboard</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    role="button"
                                    aria-haspopup="true"
                                    aria-expanded="false">Movies</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="./add-movie.php">Add Movie</a>
                                    <a class="dropdown-item" href="./view-movie.php">View Movies</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    role="button"
                                    aria-haspopup="true"
                                    aria-expanded="false">Cinemas</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="./add-cinema.php">Add Cinema</a>
                                    <a class="dropdown-item" href="./view-cinema.php">View Cinemas</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    role="button"
                                    aria-haspopup="true"
                                    aria-expanded="false">Schedules</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Add Schedule</a>
                                    <a class="dropdown-item" href="#">View Schedules</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./index.php">Bookings</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./index.php">Reviews</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./index.php">Users</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
<?php }
?>



<?php
function imgverif($file, $prefix)
{
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

    // If it's already a YouTube video ID
    if (preg_match('/^[A-Za-z0-9_-]{11}$/', $input)) {
        return $input;
    }

    $parts = parse_url($input);

    // Normal YouTube link
    if (isset($parts["query"])) {
        parse_str($parts["query"], $query);

        if (isset($query["v"])) {
            return $query["v"];
        }
    }

    // Short youtu.be link
    if (isset($parts["host"]) && $parts["host"] == "youtu.be") {
        return ltrim($parts["path"], "/");
    }

    return false;
}


function selectdata($table, $id = null)
{
    global $conn;

    if ($id !== null) {
        $result = mysqli_query($conn, "Select * from $table where id = $id");
    } else {
        $result = mysqli_query($conn, "Select * from $table");
    }

    return $result;
}
?>