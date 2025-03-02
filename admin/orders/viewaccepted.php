<?php

include "../../connect.php";

getAllData("ordersview","orders_status Not in (0,4)");