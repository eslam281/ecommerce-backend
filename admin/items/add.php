<?php
include '../../connect.php';

$table = "items";

$name   = filterRequest("name");
$namear = filterRequest("namear");
$categ = filterRequest("categ");
$desc = filterRequest("desc");
$descar = filterRequest("desc_ar");
$count = filterRequest("count");
$active = filterRequest("active");
$price = filterRequest("price");
$discount = filterRequest("discount");

$imagename = imageUpload("../../upload/items/","files");


$data = array(
"items_name"=> $name,
"items_name_ar"=> $namear,
"items_desc"=> $desc,
"items_desc_ar"=> $descar,
"items_image"=> $imagename,
"items_count"=> $count,
"items_active"=> $active,
"items_price"=> $price,
"items_discount"=> $discount,
"items_categ"=> $categ,
);

insertData($table, $data);