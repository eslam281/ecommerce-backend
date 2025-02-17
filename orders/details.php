<?php
include "../connect.php";

// $userid = filterRequest("userid");and orders_usersid = $userid
$orderid = filterRequest("orderid");

getAllData("orderdetailsview","cart_orders = $orderid ");