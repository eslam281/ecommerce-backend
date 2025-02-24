<?php
include "../../connect.php";

$orderid = filterRequest("orderid");
$userid = filterRequest("userid");
// $accesstoken = filterRequest("accesstoken");

$data=array(
"orders_status" => 4
);

updateData("orders",$data,"orders_id=$orderid AND orders_status = 3");


insertNofiy("success","Your order has been deliveried","users$userid",
$userid,$accesstoken,"","refreshOrderPeding");

// sendGCM("Alert","the order has been deliveried to the costomer","admain","","","");
