<?php

include "../connect.php";

$userid = filterRequest('userid');

$data = getAllData("cartview","cart_usersid=$userid",null,false);

$stmt = $con->prepare("SELECT SUM(itemsprice), SUM(countitems) as totalcount FROM `cartview` WHERE cart_usersid=$userid
GROUP BY cart_usersid");

$stmt->execute();
    
 $datacountprice = $stmt->fetch(PDO::FETCH_ASSOC);

 echo json_encode(array("status" => "success", "datacart" => $data,"datacountprice" => $datacountprice));