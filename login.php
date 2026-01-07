<?php

require 'DB.php';

session_start();

unset($_SESSION['error']);

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $pdo->prepare("SELECT * FROM gebruikers WHERE username = :username");
    $query->bindparam(':username', $username);
    $query->execute();
    $user = $query->fetch();

    if ($user !== false) {
        if ($password === $user['password']) {
            $_SESSION['loggedInUser'] = $user['id'];
            header("location: index.php?");
            exit;
        } else {
            $_SESSION['error'] = "wrong password!";
        }
    } else {
        $_SESSION['error'] = "user not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <title>login</title>
    </head>
    <body>
        <h1>task schedule</h1>

        <h2>Login here:</h2>
        <form class="logform" method="POST">
            <label>username: </label>
            <input class="logstl" type="text" name="username" id="username" required placeholder="enter your username">

            <label>password: </label>
            <input class="logstl" type="password" name="password" id="password" required placeholder="enter your password">

            <?php if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
            } ?>
            <button type="submit">login</button>
        </form>
        <a href="register.php">register here</a>
    </body>
</html>
