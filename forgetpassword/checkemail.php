<?php
include "../connect.php";
$email = filterRequest("email");
$verfiycode =rand(10000,99999);

$stmt =$con->prepare("SELECT * FROM users WHERE users_email = '$email' and users_approve = 1");
$stmt ->execute();

$count =$stmt->rowCount();
result($count);
if($count>0){
    $data= array("users_verfiycode"=>$verfiycode);
    updateData("users",$data,"users_email = '$email'",false);
    // sendEmail($email,"Verfiy code ecommerce app ","Verfiy code $verfiycode");
}