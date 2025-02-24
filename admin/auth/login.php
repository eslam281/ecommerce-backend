<?php
include "../../connect.php";

$password =sha1($_POST['password']);
$email =filterRequest("email");


getData("admin","admin_email = ? and admin_password = ?"
,array($email,$password));