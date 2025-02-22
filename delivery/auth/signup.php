<?php
include "../../connect.php";

$username =filterRequest("username");
$password =sha1($_POST['password']);
$email =filterRequest("email");
$phone =filterRequest("phone");
$verfiycode =rand(10000,99999);

$stmt = $con->prepare("SELECT * FROM delivery WHERE delivery_email = ? OR delivery_phone = ? ");
$stmt->execute(array($email,$phone));

$count = $stmt->rowCount();
if($count>0){
    printFailure("Phone or Email");
}else{
    $data =array(
        "delivery_name"       => $username,
        "delivery_password"   => $password,
        "delivery_email"      => $email,
        "delivery_phone"      => $phone,
        "delivery_verifycode" => $verfiycode,
    );
    // sendEmail($email,"Verfiy code ecommerce app ","Verfiy code $verfiycode");
    insertData("delivery",$data,);
}