<?php

include"../../connect.php";


$deliveryid = filterRequest("deliveryid");

getAllData("ordersview","orders_delivery =$deliveryid AND orders_status = 4");