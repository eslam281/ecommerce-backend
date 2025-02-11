<?php
include "../connect.php";

$userid = filterRequest("userid");
$addressid = filterRequest("addressid");
$orderstyp = filterRequest("orderstyp");
$pricedelivery = filterRequest("pricedelivery");
$ordersprice = filterRequest("ordersprice");
$couponid = filterRequest("couponid");
$coupondiscount = filterRequest("coupondiscount");
$pamentmethod = filterRequest("pamentmethod");

if($orderstyp == "1"){
    $pricedelivery=0;
}
$totalprice = $ordersprice+ $pricedelivery;

$now = date("Y-m-d H:i:s");
$checkcoupon = getData("coupon"," coupon_id = '$couponid' AND coupon_expiredate > '$now' AND coupon_count > 0"
,null,false);

if($checkcoupon>0){
    $totalprice = $totalprice - $ordersprice * $coupondiscount/100 ;
    $stmt= $con->prepare("UPDATE `coupon` SET `coupon_count`= coupon_count-1 Where coupon_id = '$couponid'");
    $stmt->execute();
}

$data = array(
    "orders_usersid" => $userid,
    "orders_address" => $addressid,
    "orders_type" => $orderstyp,
    "orders_pricedelivery" => $pricedelivery,
    "orders_price" => $ordersprice,
    "orders_coupon" => $couponid,
    "orders_totalprice" => $totalprice,
    "orders_paymentmethod" => $pamentmethod,
);

$count = insertData("orders",$data,false);

if($count > 0){
    $stmt = $con->prepare("SELECT Max(orders_id) from orders");
    $stmt->execute();
    $maxid = $stmt->fetchColumn();
    
    $data = array("cart_orders"=>$maxid);

    updateData("cart",$data,"cart_usersid =$userid AND cart_orders =0");
}