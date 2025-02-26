<?php
include '../../connect.php';

$table = "categories";

$id = filterRequest("id");
$imagename = filterRequest("imagename");

deleteFile("../../upload/categories/",$imagename);

deleteData($table, "categories_id =$id");