<?php
 
 include "../connect.php";

 $userid = filterRequest('userid');
 $itemsid= filterRequest('itemsid');
 $data = array(
    "cart_usersid"  =>   $userid , 
    "cart_itemsid"  =>   $itemsid
    );

//  getData("cart","cart_itemsid = $itemsid AND cart_userid = $userid",null,false);


 insertData("cart",$data);
