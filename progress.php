<?php 

require "DB.php";

session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die();
}

if (isset($_GET['id']) && isset($_GET['done'])) {
    $id = $_GET['id'];
    $progress = $_GET['done'];
}

$yes = "yes";
$no = "no";

if ($progress === "yes") {
    $qr = $pdo->prepare("UPDATE taken SET done = ? WHERE id = ?");
    $qr->bindparam(1, $no);
    $qr->bindparam(2, $id);
    $qr->execute();
} else if ($progress === "no") {
    $qr = $pdo->prepare("UPDATE taken SET done = ? WHERE id = ?");
    $qr->bindparam(1, $yes);
    $qr->bindparam(2, $id);
    $qr->execute();
} else {
    header("location: index.php?editer=wrong");
}

header("location: index.php");