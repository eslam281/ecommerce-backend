<?php
include "../../connect.php";
$email = filterRequest("email");
$verfiycode =rand(10000,99999);

$stmt =$con->prepare("SELECT * FROM `admin` WHERE admin_email = '$email' and admin_approve = 1");
$stmt ->execute();

$count =$stmt->rowCount();
result($count);
if($count>0){
    $data= array("admin_verifeycode"=>$verfiycode);
    updateData("admin",$data,"admin_email = '$email'",false);
    // sendEmail($email,"Verfiy code ecommerce app ","Verfiy code $verfiycode");
}