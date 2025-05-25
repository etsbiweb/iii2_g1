<?php
include 'dbh.inc.php';

if (isset($_POST['ispravka'])) {

    $userName = $_POST["userName"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $address = $_POST["address"];
    $about= $_POST["about"];

  
    // Ako nema slike, samo ažuriraj podatke
    if ($velicinaSlike == 0) {
        $user->urediIgracaBezSlike($UserID, $userName, $address, $phoneNumber, $email, $about);
    } 
}