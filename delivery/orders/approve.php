<?php
include "../../connect.php";

$orderid = filterRequest("orderid");
$userid = filterRequest("userid");
$deliveryid = filterRequest("deliveryid");
// $accesstoken = filterRequest("accesstoken");

$data=array(
"orders_status" => 3,
"orders_delivery" =>$deliveryid
);

updateData("orders",$data,"orders_id=$orderid AND orders_status = 2");


// insertNofiy("success","Your order is on the way",$userid,$accesstoken,"","refreshOrderPeding");

// sendGCM("Alert","the order has been approved by delivery","admain","","","");

// sendGCM("Warning","the order has been approved by delivery $deliveryid","delivery","","","");
