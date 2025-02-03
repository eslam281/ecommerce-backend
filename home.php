<?php
include "connect.php";

$alldata = array();

$categories = getAllData("categories",null,null,false);

$alldata['status']= "success";
$alldata['categories'] = $categories;

$categories = getAllData("items1view","items_discount > 0",null,false);
$alldata['items'] = $categories;

echo json_encode($alldata);