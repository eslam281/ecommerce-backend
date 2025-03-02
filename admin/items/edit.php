<?php
include '../../connect.php';

$table = "items";

$id = filterRequest("id");
$name   = filterRequest("name");
$namear = filterRequest("namear");
$categ = filterRequest("categ");
$desc = filterRequest("desc");
$descar = filterRequest("desc_ar");
$count = filterRequest("count");
$active = filterRequest("active");
$price = filterRequest("price");
$discount = filterRequest("discount");
$imagenameold = filterRequest("imagenameold");

$res = imageUpload("../../upload/items/","files");

if($res == "empty"){
    $data = array(
        "items_name"=> $name,
        "items_name_ar"=> $namear,
        "items_categ"=> $categ,
        "items_desc"=> $desc,
        "items_desc_ar"=> $descar,
        "items_count"=> $count,
        "items_active"=> $active,
        "items_price"=> $price,
        "items_discount"=> $discount,
    );
}else{
 
    deleteFile("../../upload/items/",$imagenameold);
    $data = array(
        "items_name"=> $name,
        "items_name_ar"=> $namear,
        "items_categ"=> $categ,
        "items_desc"=> $desc,
        "items_desc_ar"=> $descar,
        "items_count"=> $count,
        "items_active"=> $active,
        "items_price"=> $price,
        "items_discount"=> $discount,
        "items_image"=> $res,
    );
}


updateData($table, $data,"items_id = $id");