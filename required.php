<?php
// Start session support for user login and role tracking
session_start();

// Create a reusable database connection for the application
$conn = mysqli_connect('localhost', 'root', '', 'movie-booking-system');

// Display a JavaScript alert message in the browser
function alertjs($content){
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
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <!-- JQuery -->
    <script src="./jquery-3.7.1.js"></script>
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
                    ShowRadar
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
                            <a class="nav-link" href="./index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./movies.php">Movies</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./cinemas.php">Cinemas</a>
                        </li>

                        <?php if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "admin") { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./admin/index.php">Admin</a>
                            </li>
                        <?php } ?>

                    </ul>

                    <form class="d-flex me-3">
                        <input
                            class="form-control me-2"
                            type="search"
                            placeholder="Search">

                        <button
                            class="btn btn-outline-light"
                            type="submit">
                            Search
                        </button>
                    </form>

                    <ul class="navbar-nav">

                        <?php if (isset($_SESSION["user_name"])) { ?>

                            <li class="nav-item dropdown">

                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    data-bs-toggle="dropdown">

                                    <?= $_SESSION["user_name"]; ?>

                                </a>

                                <div class="dropdown-menu dropdown-menu-end">

                                    <a class="dropdown-item" href="./profile.php">
                                        Profile
                                    </a>

                                    <a class="dropdown-item" href="./my-bookings.php">
                                        My Bookings
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a
                                        class="dropdown-item text-danger"
                                        href="./logout.php">
                                        Log Out
                                    </a>

                                </div>

                            </li>

                        <?php } else { ?>

                            <li class="nav-item">
                                <a class="nav-link" href="./login.php">
                                    Log In
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./register.php">
                                    Register
                                </a>
                            </li>

                        <?php } ?>

                    </ul>

                </div>

            </div>
        </nav>
    </header>
<?php } ?>

<?php
function register()
{
    if (isset($_POST['submit'])) {
        global $conn;

        // Collect user input from registration form
        $f_name = $_POST['f-name'];
        $l_name = $_POST['l-name'];
        $email = $_POST['email'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

        // Insert a new user account into the database
        if (
            mysqli_query($conn, "insert into accounts (`first_name`, `last_name`, `email`, `password`, `role`) values('$f_name', '$l_name', '$email', '$pass', 'user')")
        ) {
            header("Location: ./login.php");
            exit;
        }
    }
}

function login()
{
    if (isset($_POST['submit'])) {
        global $conn;

        // Collect login credentials from the form
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $query = mysqli_query($conn, "select * from accounts where email='$email'");

        if (
            mysqli_num_rows($query) > 0
        ) {
            $col = mysqli_fetch_array($query);

            // Verify the submitted password against the stored hash
            if (
                password_verify($pass, $col['password'])
            ) {
                $_SESSION["user_name"] = $col['first_name'] . " " . $col['last_name'];
                $_SESSION["user_role"] = $col['role'];
                header("Location: ./index.php");
                exit;
            } else {
                alertjs('Password Incorrect');
            }
        } else {
            alertjs('Account not found');
        }
    }
}
?>