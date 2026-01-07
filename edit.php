<?php

require "DB.php";

session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    exit;
}

$userID = $_SESSION['loggedInUser'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location: index.php?editer=nietgelukt');
    exit;
}

$qr = $pdo->prepare("SELECT * FROM taken WHERE id = :id");
$qr->bindparam(':id', $id);
$qr->execute();
$taken = $qr->fetch();

if ($taken['gebruikerID'] != $userID) {
    header("location: index.php?editer=nee");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <title>edit</title>
    </head>
    <body>
        <a href="index.php" class="navi">← back to tasks</a>
        <h1 class="title">tasks editer</h1>
        <form class="add" action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">

            <label>task: </label>
            <input class="ad" type="text" name="task" value="<?php echo $taken['task'] ?>" required>

            <label>deadline: </label>
            <input class="ad" type="date" name="deadline" value="<?php echo $taken['deadline'] ?>" required>

            <button type="submit">edit</button> 
        </form>
    </body>
</html>