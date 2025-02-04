<?php

include "../connect.php";

$userid = filterRequest('userid');

$data = getAllData("cartview","cart_usersid=$userid",null,false);

$stmt = $con->prepare("SELECT SUM(itemsprice), SUM(countitems) as totalcount FROM `cartview` WHERE cart_usersid=$userid");

$stmt->execute();
    
 $datacountprice = $stmt->fetch();

 echo json_encode(array("status" => "success", "datacart" => $data,"datacountprice" => $datacountprice));