<?php
include_once 'dbh.inc.php';
$id = $_GET['id'];
$user->deleteUser($id);
header("Location: ../signin.php");
 exit();