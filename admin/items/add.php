<?php
include '../../connect.php';

$table = "items";

$name   = filterRequest("name");
$namear = filterRequest("namear");
$categ = filterRequest("items_categ");
$desc = filterRequest("items_desc");
$descar = filterRequest("items_desc_ar");
$count = filterRequest("items_count");
$active = filterRequest("items_active");
$price = filterRequest("items_price");
$discount = filterRequest("items_discount");

$imagename = imageUpload("../../upload/items/","files");


$data = array(
"items_name"=> $name,
"items_name_ar"=> $namear,
"items_categ "=> $categ,
"items_desc"=> $desc,
"items_desc_ar"=> $descar,
"items_image"=> $imagename,
"items_count"=> $count,
"items_active"=> $active,
"items_price"=> $price,
"items_discount"=> $discount,
);

insertData($table, $data);