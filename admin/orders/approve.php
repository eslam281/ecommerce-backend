<?php
include "../../connect.php";

$orderid = filterRequest("orderid");
$userid = filterRequest("userid");
$accesstoken = filterRequest("accesstoken");

$data=array(
"orders_status" => 1
);

updateData("orders",$data,"orders_id=$orderid AND orders_status =0",false);

sendGCM("success","The order has been approved","users$userid","","",$accesstoken);

printSuccess();