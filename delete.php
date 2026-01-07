<?php

require 'DB.php';

session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    exit;
}

$userID = $_SESSION['loggedInUser'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$quer = $pdo->prepare("SELECT gebruikerID FROM taken WHERE id =:id");
$quer->bindparam(':id', $id);
$quer->execute();
$taken = $quer->fetch();

if ($taken['gebruikerID'] != $userID) {
    header('location: index.php?editer=nah');
    exit;
}

$qr = $pdo->prepare("DELETE FROM taken WHERE id = :id");
$qr->bindparam(':id', $id);
$qr->execute();

header("location: index.php");
exit;
?>