<?php
// Start session on all user pages
session_start();

// Database connection shared by all pages
$conn = mysqli_connect('localhost', 'root', '', 'movie-booking-system');

// PHP function to use JavaScript alert to not write the js code again and again
function alertjs($content)
{
    echo "<script> alert(" . json_encode($content) . ") </script>";
}

// PHP function to redirect to a different page using JavaScript
function redirect($url)
{
    echo "<script> window.location.href = " . json_encode($url) . " </script>";
    exit;
}


// PHP function to include the head section of the HTML document with a dynamic title given as parameter
function head($title)
{
?>
    <title><?php echo $title; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/required.css">
    <!-- JQuery -->
    <script src="./jquery-3.7.1.js"></script>
<?php
}
?>

<?php
// PHP function to display the main website navigation bar
function navbar()
{ ?>
    <header>

        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">

            <div class="container">

                <!-- Website logo -->
                <a class="navbar-brand fw-bold fs-4" href="./index.php">

                    🎬 ShowRadar

                </a>


                <!-- Mobile navigation toggle -->
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId">

                    <span class="navbar-toggler-icon"></span>

                </button>


                <div class="collapse navbar-collapse" id="collapsibleNavId">

                    <!-- Main navigation links -->
                    <ul class="navbar-nav me-auto ms-3">

                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">
                                Home
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./movies.php">
                                Movies
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./cinemas.php">
                                Cinemas
                            </a>
                        </li>

                        <?php if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "admin") { ?>

                            <li class="nav-item">
                                <a class="nav-link" href="./admin/index.php">
                                    Admin
                                </a>
                            </li>

                        <?php } ?>

                    </ul>


                    <!-- Search form -->
                    <form
                        class="d-flex me-4"
                        method="GET"
                        action="./movies.php">

                        <input
                            class="form-control me-2"
                            type="search"
                            name="search"
                            placeholder="Search movies...">

                        <button
                            class="btn btn-danger"
                            type="submit">

                            Search

                        </button>

                    </form>


                    <!-- User navigation -->
                    <ul class="navbar-nav">

                        <?php if (isset($_SESSION["user_name"])) { ?>

                            <li class="nav-item dropdown">

                                <a
                                    class="nav-link dropdown-toggle fw-semibold"
                                    href="#"
                                    data-bs-toggle="dropdown">

                                    👤 <?= $_SESSION["user_name"]; ?>

                                </a>

                                <div class="dropdown-menu dropdown-menu-end">

                                    <a class="dropdown-item" href="./profile.php">
                                        Profile
                                    </a>

                                    <a class="dropdown-item" href="./my-bookings.php">
                                        My Bookings
                                    </a>

                                    <?php if ($_SESSION["user_role"] === "admin") { ?>

                                        <a class="dropdown-item" href="./admin/index.php">
                                            Admin Panel
                                        </a>

                                    <?php } ?>

                                    <div class="dropdown-divider"></div>

                                    <a
                                        class="dropdown-item text-danger"
                                        href="./logout.php">

                                        Log Out

                                    </a>

                                </div>

                            </li>

                        <?php } else { ?>

                            <li class="nav-item me-2">

                                <a
                                    class="btn btn-outline-light"
                                    href="./login.php">

                                    Log In

                                </a>

                            </li>

                            <li class="nav-item">

                                <a
                                    class="btn btn-danger"
                                    href="./register.php">

                                    Register

                                </a>

                            </li>

                        <?php } ?>

                    </ul>

                </div>

            </div>

        </nav>

    </header>
<?php
}

// PHP function to include the footer section of the HTML document
function footer()
{ ?>
    <footer class="bg-dark text-light mt-5 py-4 position-relative bottom-0 w-100">
        <div class="container">
            <div class="row">

                <div class="col-md-4 mb-3">
                    <h5>ShowRadar</h5>
                    <p class="mb-0">
                        Your one-stop destination for browsing movies, cinemas, and booking tickets online.
                    </p>
                </div>

                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="./index.php" class="text-light text-decoration-none">Home</a></li>
                        <li><a href="./movies.php" class="text-light text-decoration-none">Movies</a></li>
                        <li><a href="./cinemas.php" class="text-light text-decoration-none">Cinemas</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-3">
                    <h5>Account</h5>
                    <ul class="list-unstyled">
                        <li><a href="./login.php" class="text-light text-decoration-none">Log In</a></li>
                        <li><a href="./register.php" class="text-light text-decoration-none">Register</a></li>
                        <li><a href="./my-bookings.php" class="text-light text-decoration-none">My Bookings</a></li>
                    </ul>
                </div>

            </div>

            <hr class="border-secondary">

            <div class="text-center">
                &copy; <?php echo date("Y"); ?> ShowRadar. All rights reserved.
            </div>
        </div>
    </footer>

<?php
}

// PHP function to handle user registration logic
function register()
{
    if (isset($_SESSION["user_id"])) {
        redirect("./index.php");
    } else {
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
}

// PHP function to handle user login logic
function login()
{
    if (isset($_SESSION["user_id"])) {
        redirect("./index.php");
    } else {
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
                if (password_verify($pass, $col['password'])) {

                    // Store logged in user information in the session
                    $_SESSION["user_id"] = $col["id"];
                    $_SESSION["user_name"] = $col["first_name"] . " " . $col["last_name"];
                    $_SESSION["user_email"] = $col["email"];
                    $_SESSION["user_role"] = $col["role"];

                    header("Location: ./index.php");
                    exit;
                } else {

                    alertjs("Password Incorrect");
                }
            } else {
                alertjs('Account not found');
            }
        }
    }
}

// Function to select data from MySQL database, either all rows or a specific row by ID
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

// Function to get a specific column value from a MySQL database table based on the provided ID
function getvalue($table, $column, $id)
{
    global $conn;

    $query = mysqli_query($conn, "SELECT $column FROM $table WHERE id = $id");
    $row = mysqli_fetch_assoc($query);

    return $row[$column];
}

// Function to count the total number of rows in a MySQL database table
function countdata($table)
{
    global $conn;

    $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM $table");
    $row = mysqli_fetch_assoc($query);

    return $row["total"];
}

// Function to validate user login and fetch profile information
function profiledata()
{
    global $conn;

    // Redirect guests to the login page
    if (!isset($_SESSION["user_id"])) {

        alertjs("Please log in to access your profile.");
        redirect("./login.php");
    }

    // Fetch the currently logged in user's information
    $query = mysqli_query(
        $conn,
        "SELECT *
         FROM accounts
         WHERE id = " . $_SESSION["user_id"]
    );

    return mysqli_fetch_assoc($query);
}
?>