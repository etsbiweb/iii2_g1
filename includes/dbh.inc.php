<?php
require 'User.php';
$user = new User('localhost:3306', 'dbgym', 'root', '');


$server = "localhost:3306";
$korisnicko = "root";
$pass = "";
$baza="dbgym";
try {
 $conn = new PDO("mysql:host=$server; dbname=$baza;",$korisnicko,$pass);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
 $_SESSION['db_error']='<div class="alert alert-danger" role="alert">
  Greška u konekciji sa DB 💥: <span>'.$e->getMessage().'</span>
 </div>';
 header("Location: ../index.php");
 exit();
}