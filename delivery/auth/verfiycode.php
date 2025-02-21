<?php
include "../../connect.php";
$email = filterRequest("email");

$verfiycode = filterRequest("verfiycode");

$stmt =$con->prepare("SELECT * FROM delivery WHERE delivery_email = '$email' AND delivery_verfiycode= '$verfiycode'");
$stmt ->execute();

$count =$stmt->rowCount();
if($count>0){
    $data =array("delivery_approve" => '1');
    updateData("delivery",$data , "delivery_email = '$email'");
}else{
    printFailure("verifcode not correct");
}
