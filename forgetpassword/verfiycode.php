<?php
include "../connect.php";
$email = filterRequest("email");

$verfiycode = filterRequest("verfiycode");

$stmt =$con->prepare("SELECT * FROM users WHERE users_email = '$email' AND users_verfiycode= '$verfiycode'");
$stmt ->execute();

$count =$stmt->rowCount();
result($count);
