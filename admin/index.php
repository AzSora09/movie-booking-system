<?php
include("./adminrequired.php");
// Admin dashboard entry page. Shared admin layout utilities are loaded from adminrequired.php.
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("Movie Booking System");
    ?>
</head>

<body>
    <?php
    // Render the admin navigation bar at the top of the page
    navbar();
    ?>


    <main>
        <!-- Admin dashboard content can be added here -->
    </main>


    <footer>
        <!-- Admin footer content can be added here -->
    </footer>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>