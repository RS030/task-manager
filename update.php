<?php

require 'DB.php';

session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die();
}

$userID = $_SESSION['loggedInUser'];

if (isset($_POST['task']) && !empty($_POST['task'])) {
    $task = $_POST['task'];
    $deadline = $_POST['deadline'];
    $id = $_POST['id'];
    
    $qr = $pdo->prepare(
    "UPDATE taken SET
    task = ?,
    deadline = ?
    WHERE id = ?"
);
$qr->bindparam(1, $task);
$qr->bindparam(2, $deadline);
$qr->bindparam(3, $id);
$qr->execute();

}

header("location: index.php");
?>