<?php
include "../connect.php";
$email = filterRequest("email");

$verfiycode = filterRequest("verfiycode");

$stmt =$con->prepare("SELECT * FROM delivery WHERE delivery_email = '$email' AND delivery_verifeycode= '$verfiycode'");
$stmt ->execute();

$count =$stmt->rowCount();
result($count);
