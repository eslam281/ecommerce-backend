<?php
include '../../connect.php';

$table = "items";

$id = filterRequest("id");
$imagename = filterRequest("imagename");

deleteFile("../../upload/items/",$imagename);

deleteData($table, "items_id =$id");