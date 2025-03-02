<?php
include "../../connect.php";

$orderid = filterRequest("orderid");
$userid = filterRequest("userid");
// $accesstoken = filterRequest("accesstoken");

$data=array(
"orders_status" => 1
);

$count = updateData("orders",$data,"orders_id=$orderid AND orders_status = 0",false);

// if ($count > 0) {
//     $count =  insertNofiy("success","The order $orderid has been approved","users$userid"
//     ,$userid,$accesstoken,"","refreshOrderPeding");
//     if ($count > 0) {
//     //     $result= sendGCM("success","The order has been approved","users$userid","",
//     // "refreshOrderPeding",$accesstoken);
//     // $result =json_Decode($result);,"result" =>$result
//     echo json_encode(array("status" => "success" ));
//     } else {
//         echo json_encode(array("status" => "failure add Notification"));
//     }
// } else {
//     echo json_encode(array("status" => "failure update"));
// }

