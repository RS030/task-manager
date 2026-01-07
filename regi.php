<?php

require "DB.php";

$status = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');


    if ($username == '' || $password == '') {
        $status = "please enter a valid username and password!";
    } else {
        $check = $pdo->prepare("SELECT id FROM gebruikers WHERE username = :username");
        $check->bindParam(':username', $username);
        $check->execute();


        if ($check->fetch()) {
            $status = "username already exists, try logging in!";
        } else {
            $qr = $pdo->prepare("INSERT INTO gebruikers (username, password) VALUES(:username, :password)");
            $qr->bindparam(':username', $username);
            $qr->bindparam(':password', $password);
            $qr->execute();
            $status = "register is succesfull return to login page";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php if ($status == "please enter a valid username and password!") { ?>
        <h3><?php echo $status ?></h3>
    <a href="register.php">try again</a>
    <?php } else { ?>
    <h3><?php echo $status ?></h3>
    <a href="login.php">return to login page</a>
    <?php } ?>
</body>

</html>