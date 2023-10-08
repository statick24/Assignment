<?php
require_once "autoload.php";
session_start();
if (isset($_POST['submit'])) {
    $controller = new CreateUserController();
    $controller->handleRequest();
}
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../app/Login.php');
}
if (!isset($_SESSION['email']) || $_SESSION['role'] != 1) {
    header('Location: ../app/Dashboard.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>
    <main>
        <header class="row">
            <div class="col-2 col-m-2"><img src="research.png" alt="Research Logo" width="50" height="50"></div><!-- Source:https://www.flaticon.com/free-icons/scientific -->
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
        <div class="error ">
            <?php
            if (!empty($_POST['errors']) && isset($_POST['submit'])) : ?>
                <ul>
                    <?php
                    foreach ($_POST['errors'] as $category => $msg) : ?>
                        <li><?php echo $category . ': ' . $msg . '<br>' ?></li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            <?php endif; ?>

        </div>
        <div class="success">
            <?php
            if (isset($_POST['success']) && isset($_POST['submit'])) : ?>

                <ul>
                    <li>User successfully created</li>
                </ul>

            <?php endif; ?>
        </div>

        <section>
            <div class="form-container row">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-3">
                            <label for="user">Username:</label>
                        </div>
                        <div class="col-3">
                            <input type="text" name="user" id="user">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="email">Email:</label>
                        </div>
                        <div class="col-3">
                            <input type="email" name="email" id="f_email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="pwd">Password:</label>
                        </div>
                        <div class="col-3">
                            <input type="password" name="pwd" id="pwd">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="pwd">Role:</label>
                        </div>
                        <div class="col-3">
                            <select name="role" id="f_role">
                                <option value="2" selected>Research Study Manager</option>
                                <option value="3">Researcher</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 center">
                            <input type="submit" name="submit" value="Register">
                        </div>
                    </div>
                </form>
            </div>
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