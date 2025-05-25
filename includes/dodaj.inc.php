<?php

session_start();
require_once 'dbh.inc.php';

if (isset($_POST["add"])) {
    $userName = $_POST["userName"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $address = $_POST["address"];
    $about = $_POST["about"];

    if (empty($userName) || empty($gender) || empty($email) || empty($phoneNumber) || empty($address) || empty($about)) {
        $_SESSION['db_error'] = '<div class="alert alert-danger" role="alert">Fill in all fields</div>';
        header("Location: ../signin.php");
        exit();
    }

    // Funkcija s ispravnim brojem argumenata
    $user->addUser($userName, $gender, $email , $phoneNumber ,$address, $about);

    header("Location: ../signin.php");
    exit();
}

$result = $user->addUser($userName, $gender, $email , $phoneNumber ,$address, $about);
if (!$result) {
    echo $_SESSION['db_error']; // Prikazuje grešku
    exit();

}





