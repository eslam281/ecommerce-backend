<?php

include"../connect.php";

$userid = filterRequest("userid");

getAllData("ordersview","orders_usersid = $userid AND orders_status = 4");
