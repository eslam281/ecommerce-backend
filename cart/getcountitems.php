<?php
 
 include "../connect.php";

 $userid = filterRequest('userid');
 $itemsid= filterRequest('itemsid');
//  $data = array("cart_usersid"=>$userid , "cart_itemsid" =>$itemsid);

 $stmt = $con->prepare(
    "SELECT COUNT(cart.cart_id) as countitems FROM `cart` WHERE cart_usersid =$userid AND cart_itemsid= $itemsid AND cart_orders = 0");

 $stmt->execute();
    
 $data = $stmt->fetchColumn();
 $count = $stmt->rowCount();

 if($count>0){
    printSuccess($data);
 }else{
     printSuccess($data="0");
 }

