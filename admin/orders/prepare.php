<?php
include "../../connect.php";

$orderid = filterRequest("orderid");
$userid = filterRequest("userid");
// $accesstoken = filterRequest("accesstoken");
$ordertype = filterRequest("ordertype");

if($ordertype == "0"){

    $data=array("orders_status" => 2 );

    // insertNofiy("success","The order $orderid has been approved","users$userid",$userid,$accesstoken,"","refreshOrderPeding");

    // sendGCM("Alert","there is order waiting approve","delivery","","","");

}else{
    $data=array("orders_status" => 4);

    // insertNofiy("success","The order $orderid has been risved","users$userid",
    // $userid,$accesstoken,"","refreshOrderPeding");
}


updateData("orders",$data,"orders_id=$orderid AND orders_status = 1",false);


