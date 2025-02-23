<?php
include "../../connect.php";

$orderid = filterRequest("orderid");
$userid = filterRequest("userid");
$accesstoken = filterRequest("accesstoken");

$data=array(
"orders_status" => 4
);

updateData("orders",$data,"orders_id=$orderid AND orders_status = 3",false);


// insertNofiy("success","Your order has been deliveried",$userid,$accesstoken,"","refreshOrderPeding");

// sendGCM("Alert","the order has been deliveried to the costomer","admain","","","");
