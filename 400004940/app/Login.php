<?php
require_once "autoload.php";
if (isset($_POST['submit'])) {
    $controller = new LoginController();
    $controller->handleRequest();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/stylesheet.css" type="text/css">
</head>
<body>
    <main>
        <header class="row">
            <div class="col-2"><img src="research.png" alt="Research Logo" width="50" height="50"></div><!-- Source:https://www.flaticon.com/free-icons/scientific -->
        </header>
        <div class="error">
            <?php
            if (!empty($_POST['errors']) && isset($_POST['submit'])) : ?>
                <ul>
                    <?php
                    foreach ($_POST['errors'] as $category => $msg) : ?>
                        <li class="center"><?php echo $category . ': ' . $msg . '<br>' ?></li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            <?php endif; ?>
        </div>
        <section>
            <div class="form-container">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-2"><!-- Empty cell --></div>
                        <div class="col-3">
                            <label for="email">Email:</label>
                        </div>
                        <div class="col-3">
                            <input type="text" name="email" id="email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2"><!-- Empty cell --></div>
                        <div class="col-3">
                            <label for="pwd">Password:</label>
                        </div>
                        <div class="col-3">
                            <input type="password" name="pwd" id="pwd">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 center">
                            <input type="submit" name="submit" value="Log in">
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