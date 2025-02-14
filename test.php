<?php
include "connect.php";

$accesstoken = filterRequest("accesstoken");

sendGCM("hi","How Are You","users","","",$accesstoken);
sendGCM("hi eslam","How Are You eslam","users19","","",$accesstoken);

echo "Send";