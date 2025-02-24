<?php
include "../../connect.php";
$email = filterRequest("email");

$verfiycode = filterRequest("verfiycode");

$stmt =$con->prepare("SELECT * FROM `admin` WHERE admin_email = '$email' AND admin_verifycode= '$verfiycode'");
$stmt ->execute();

$count =$stmt->rowCount();
if($count>0){
    $data =array("admin_approve" => '1');
    updateData("admin",$data , "admin_email = '$email'");
}else{
    printFailure("verifcode not correct");
}
