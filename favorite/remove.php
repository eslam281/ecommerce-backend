<?php
 
 include "../connect.php";

 $itemsid= filterRequest('itemsid');
 $userid = filterRequest('userid');

 deleteData("favorite","`favorite_usersid`=$userid and`favorite_itemsid`= $itemsid");
