<?php
include '../../connect.php';

$table = "categroies";

$name = filterRequest("name");
$namear = filterRequest("namear");

$imagename = imageUpload("../../upload/categroies","files");


$data = array(
"categories_name"=> $name,
"categories_name_ar"=> $namear,
"categories_image"=> $imagename,
);

insertData($table, $data);