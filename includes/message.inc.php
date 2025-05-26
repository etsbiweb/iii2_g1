<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once 'dbh.inc.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $message = $_POST['message'];
    $created_at = $_POST['created_at'];
   
 $qInsert = $conn->prepare("INSERT INTO `messages`( `created_at`, `message`) VALUES (?,?)");
 $qInsert->execute([ $created_at, $message]);
   $_SESSION['add'] = '<div class="alert" role="alert" style="background-color: black; color: white;  font-family: "Font Awesome 5 Free" ">
  Your message was sent!
</div>';

 header("Location: ../index.php");
 exit();
}