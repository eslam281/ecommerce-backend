<?php
include "../connect.php";

// $userid = filterRequest("userid");and orders_usersid = $userid
$orderid = filterRequest("orderid");

getAllData("orderdetailsview","orders_id = $orderid ");