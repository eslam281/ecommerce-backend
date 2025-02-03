<?php
 
 include "../connect.php";

 $userid = filterRequest('userid');

 getAllData("myfavorite","users_id=$userid");