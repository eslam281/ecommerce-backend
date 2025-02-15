<?php
include "connect.php";

$userid = filterRequest('userid');


 $stmt = $con->prepare("SELECT * FROM `notification` where notification_userid = $userid  ORDER by notification_datetime DESC");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count  = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}