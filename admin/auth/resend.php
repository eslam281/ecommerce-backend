<?php
include "../../connect.php";

$email = filterRequest("email");
$verfiycode =rand(10000,99999);
$data = array("admin_verifycode" => $verfiycode);

updateData("admin",$data,"admin_email = '$email'",false);

// sendEmail($email,"Verify Code Ecommerce ","Verify code $verfiycode");

printSuccess();
