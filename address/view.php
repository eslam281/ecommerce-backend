<?php

include "../connect.php";

$id=filterRequest("userid");

getAllData("address","address_usersid=$id");