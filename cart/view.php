<?php

include "../connect.php";

$userid = filterRequest('userid');

$data = getAllData("cartview","cart_usersid=$userid",null,false);

$stmt = $con->prepare("SELECT SUM(itemsprice) as totalprice,
 SUM(countitems) as totalcount FROM `cartview` WHERE cart_usersid=$userid AND cart_orders = 0
 GROUP BY cart_usersid");

$stmt->execute();
    
 $datacountprice = $stmt->fetch(PDO::FETCH_ASSOC);

 echo json_encode(array("status" => "success", "datacart" => $data,"datacountprice" => $datacountprice));