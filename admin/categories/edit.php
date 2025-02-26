<?php
include '../../connect.php';

$table = "categroies";

$id = filterRequest("id");
$name = filterRequest("name");
$namear = filterRequest("namear");

$imagename = imageUpload("../../upload/categroies","files");

if($imagename == "empty"){
    $data = array(
        "categories_name"=> $name,
        "categories_name_ar"=> $namear,
    );
}else{
    $data = array(
        "categories_name"=> $name,
        "categories_name_ar"=> $namear,
        "categories_image"=> $imagename,
    );
}




updateData($table, $data,"categories_id = $id");