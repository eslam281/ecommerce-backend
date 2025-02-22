<?php
include "../../connect.php";

$orderid = filterRequest("orderid");
$userid = filterRequest("userid");
$accesstoken = filterRequest("accesstoken");

$data=array(
"orders_status" => 2
);

updateData("orders",$data,"orders_id=$orderid AND orders_status = 1",false);


insertNofiy("success","The order $orderid has been approved",$userid,$accesstoken,"","refreshOrderPeding");

sendGCM("Alert","there is order waiting approve","delivery","","","");