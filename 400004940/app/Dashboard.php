<?php
require_once "autoload.php";
$controller = new DashboardController();
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../app/Login.php');
}
if (!isset($_SESSION['email'])) {
    header('Location: ../app/Login.php');
}
$controller->handleRequest();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>

<body>
    <main>
        <header class="row">
            <div class="col-2 col-m-2"><img src="research.png" alt="Research Logo" width="30" height="30"></div><!-- Source:https://www.flaticon.com/free-icons/scientific -->
            <div class="col-8 col-m-5"><!-- Empty cell --></div>
            <div class="col-2 col-m-5"><a href="?logout=true" class="logout">Log out</a></div>
        </header>
        <div class="user-container">
            <div class="user row">
                <div class="col-7 col-m-12">
                    <span id="role"> <?php echo $_SESSION['role_name'] . ": " . $_SESSION['user'] ?> </span>
                </div>
                <div class="col-5 col-m-12">
                    <span id="email">Email: <?php echo $_SESSION['email'] ?></span>
                </div>
            </div>
        </div>
        <section>
            <?php if ($_SESSION['role'] < 3) : ?>
                <div class="flex-container">
                    <div class="flex-item"><a href="#">Create New Study</a></div>
                    <div class="flex-item"><a href="#">View All Studies</a></div>
                </div>
            <?php else : ?>
                <div class="flex-container">
                    <div class="flex-item"><a href="#">View All Studies</a></div>
                </div>
            <?php endif; ?>
            <?php if ($_SESSION['role'] <= 2) : ?>
                <div class="flex-container">
                    <div class="flex-item"><a href="#">Delete Previous Study</a></div>
                    <?php if ($_SESSION['role'] == 1) : ?> <div class="flex-item"><a href="CreateUser.php">Create New Researchers</a></div> <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
        <footer class="row">
            <hr>
            <div class="center">
                <strong><span>Copyright &copy; "Ajani Phillips". All Rights Reserved </span></strong>
            </div>
        </footer>

    </main>
</body>

</html>