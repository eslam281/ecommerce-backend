<?php
include "../connect.php";


$orderid = filterRequest("orderid");
$rating = filterRequest("rating");
$comment = filterRequest("comment");

$data = [
    "orders_rating" => "$rating",
    "orders_noterating" => "$comment",
];

updateData("orders", $data,"orders_id = $orderid");