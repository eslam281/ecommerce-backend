<?php
include '../../connect.php';

$table = "categories";

$id = filterRequest("id");
$name = filterRequest("name");
$namear = filterRequest("namear");
$imagenameold = filterRequest("imagename");

$res = imageUpload("../../upload/categories/","files");

if($res == "empty"){
    $data = array(
        "categories_name"=> $name,
        "categories_name_ar"=> $namear,
    );
}else{
 
    deleteFile("../../upload/categories/",$imagenameold);
    $data = array(
        "categories_name"=> $name,
        "categories_name_ar"=> $namear,
        "categories_image"=> $res,
    );
}


updateData($table, $data,"categories_id = $id");