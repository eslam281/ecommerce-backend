<?php
include "../connect.php";
$email = filterRequest("email");
$verfiycode =rand(10000,99999);

$stmt =$con->prepare("SELECT * FROM delivery WHERE delivery_email = '$email' and delivery_approve = 1");
$stmt ->execute();

$count =$stmt->rowCount();
result($count);
if($count>0){
    $data= array("delivery_verifeycode"=>$verfiycode);
    updateData("delivery",$data,"delivery_email = '$email'",false);
    // sendEmail($email,"Verfiy code ecommerce app ","Verfiy code $verfiycode");
}