<?php
 
 include "../connect.php";

 $itemsid= filterRequest('itemsid');
 $userid = filterRequest('userid');

 deleteData("cart","cart_id=(SELECT cart_id FROM `cart` WHERE `cart_usersid` =$userid AND cart_orders = 0
 AND cart_itemsid = $itemsid LIMIT 1)");
