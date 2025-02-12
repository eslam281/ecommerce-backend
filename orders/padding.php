<?php

include"../connect.php";

$userid = filterRequest("userid");

getAllData("orders","orders_usersid = $userid");