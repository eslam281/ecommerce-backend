<?php
include "../connect.php";

$userid = filterRequest("userid");
$addressid = filterRequest("addressid");
$orderstyp = filterRequest("orderstyp");
$pricedelivery = filterRequest("pricedelivery");
$ordersprice = filterRequest("ordersprice");
$couponid = filterRequest("couponid");
$pamentmethod = filterRequest("pamentmethod");

$data = array(
    "orders_usersid" => $userid,
    "orders_address" => $addressid,
    "orders_type" => $orderstyp,
    "orders_pricedelivery" => $pricedelivery,
    "orders_price" => $ordersprice,
    "orders_coupon" => $couponid,
    "orders_paymentmethod" => $pamentmethod,
);

$count = insertData("orders",$data,false);