<?php
include "connect.php";

$alldata = array();

$categories = getAllData("categories",null,null,false);

$alldata['status']= "success";
$alldata['categories'] = $categories;

$items = getAllData("itemstopselling",null,null,false);
$alldata['items'] = $items;

$settings = getData("settings",null,null,false);
$alldata['settings'] = $settings;

echo json_encode($alldata);