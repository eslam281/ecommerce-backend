<?php
include "../../connect.php";
$email = filterRequest("email");

$verfiycode = filterRequest("verfiycode");

$stmt =$con->prepare("SELECT * FROM `admin` WHERE admin_email = '$email' AND admin_verifeycode= '$verfiycode'");
$stmt ->execute();

$count =$stmt->rowCount();
result($count);
