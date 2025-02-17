<?php

include"../connect.php";

$userid = filterRequest("userid");

getAllData("ordersview","orders_usersid = $userid AND orders_status = 4");
// $stmt = $con->prepare("SELECT * FROM `ordersview` where orders_usersid = $userid AND orders_status = 4  ORDER by orders_datetime DESC");
// $stmt->execute();
// $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $count  = $stmt->rowCount();

// if ($count > 0) {
//     echo json_encode(array("status" => "success", "data" => $data));
// } else {
//     echo json_encode(array("status" => "failure"));
// }