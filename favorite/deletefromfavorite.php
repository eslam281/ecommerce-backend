<?php
 
 include "../connect.php";

 $id= filterRequest('favorite_id');
 

 deleteData("favorite","`favorite_id`=$id");
