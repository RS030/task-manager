<?php

require 'DB.php';

session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die();
}

$userid = $_SESSION['loggedInUser'];

if (isset($_POST['task']) && !empty($_POST['task'])) {
    $task = $_POST['task'];
    $deadline = $_POST['deadline'];

    $quer = $pdo->prepare("INSERT INTO taken (gebruikerID, task, deadline) VALUES(?, ?, ?)");
    $quer->bindParam(1, $userid);
    $quer->bindParam(2, $task);
    $quer->bindParam(3, $deadline);
    $quer->execute();

    header("location: index.php");
    exit;
}


$qr = $pdo->prepare("SELECT taken.*, gebruikers.username FROM taken INNER JOIN gebruikers ON taken.gebruikerID = gebruikers.id WHERE taken.gebruikerID = :userid ORDER BY deadline ASC");
$qr->bindparam(':userid', $userid);
$qr->execute();
$taken = $qr->fetchall();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>task manager</title>
</head>

<body>

    <h1 class="title">tasks manager</h1>
    <?php if (isset($taken[0]['username']) && !empty($taken[0]['username'])) { ?>
        <h2 class="user">user: <?php echo $taken[0]['username'] ?></h2>
    <?php } ?>
    <?php if (isset($_GET['editer'])) { ?>
        <p style=color:red;><?= "something gone wrong please retry!" ?></p>
    <?php } ?>
    <?php if (empty($taken)) { ?>
        <p class="empty">No tasks yet. Add one!</p>
    <?php } else { ?>
        <?php
        $total = count($taken);
        $done = 0;

        foreach ($taken as $t) {
            if ($t['done'] === 'yes') {
                $done++;
            }
        }
        $open = $total - $done;
        ?>
        <div class="stats">
            <span>Total: <?= $total ?></span>
            <span>Done: <?= $done ?></span>
            <span>Open: <?= $open ?></span>
        </div>
        <table>
            <tr>
                <th>task</th>
                <th>deadline</th>
                <th>done?</th>
            </tr>
            <?php foreach ($taken as $tasks) { ?>
                <?php
                $class = '';
                if ($tasks['done'] === 'yes') {
                    $class = 'green';
                } else if ($tasks['done'] === 'no') {
                    $class = 'red';
                }
                ?>
                <tr>
                    <td><?= $tasks['task'] ?></td>
                    <td><?= $tasks['deadline'] ?></td>
                    <td>
                        <p><a class="<?= $class ?>" href="progress.php?id=<?= $tasks['id'] ?>&done=<?= $tasks['done'] ?>"><?= $tasks['done'] ?></a></p>
                    </td>
                    <td class="delete"><a class="delete" href="delete.php?id=<?= $tasks['id'] ?>">delete</a></td>
                    <td class="edit"><a class="edit" href="edit.php?id=<?= $tasks['id'] ?>">edit</a></td>
                </tr>
            <?php } ?>
        <?php } ?>
        </table>
        <div class="addd">
        <h1>Add task:</h1>
        <form class="add" action="index.php" method="POST">
            <label>task: </label>
            <input class="ad" type="text" name="task" id="task" required placeholder="type your new task">

            <label>deadline:</label>
            <input class="ad" type="date" name="deadline" id="deadline" required>

            <button type="submit">Add</button>
        </form>
            </div>

        <a class="logout" href="logout.php">logout</a>
</body>

</html>