<?php
include '../../connect.php';

$table = "categroies";

$id = filterRequest("id");
$imagename = filterRequest("imagename");

deleteFile("../../upload/categroies",$imagename);

deleteData($table, "categroies_id =$id");