<?php
include "../../connect.php";

$email = filterRequest("email");
$verfiycode =rand(10000,99999);
$data = array("delivery_verifycode" => $verfiycode);

updateData("delivery",$data,"delivery_email = '$email'",false);

// sendEmail($email,"Verify Code Ecommerce ","Verify code $verfiycode");

printSuccess();
