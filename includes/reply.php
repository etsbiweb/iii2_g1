<?php
session_start();
include_once 'dbh.inc.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messagesID = $_POST['messageID'];
    $reply = $_POST['reply'];

    
    $qCheck = $conn->prepare("SELECT * FROM `messages` WHERE `messageID`=?");
    $qCheck->execute([$messagesID]);

    if ($qCheck->rowCount() == 0) {
        $_SESSION['add'] = '<div style="background-color: red; color: white; padding: 10px;">ERROR: message dosent exist.</div>';
        header("Location: ../adminpanel/admin.php");
        exit();
    }

    try {
        $qInsert = $conn->prepare("INSERT INTO `replies`( `messagesID`, `reply`) VALUES (?,?)");
        $qInsert->execute([$messagesID, $reply]);

        $_SESSION['add'] = '<div style="background-color: green; color: white; padding: 10px; border-radius: 8px;">Your message was sent!</div>';
    } catch (PDOException $e) {
        $_SESSION['add'] = '<div style="background-color: red; color: white; padding: 10px; border-radius: 8px;">ERROR: ' . $e->getMessage() . '</div>';
    }

    header("Location: ../adminpanel/admin.php");
    exit();
}
