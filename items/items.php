<?php

include"../connect.php";

$categoryid= filterRequest('id');
$userid= filterRequest('userid');

// getAllData("itemsview","categories_id = $categoryid");

$stmt= $con->prepare("SELECT items1view.* ,1 as favorite FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid =items1view.items_id AND favorite.favorite_usersid = $userid
Where categories_id =$categoryid
 UNION ALL
 SELECT *, 0 as favorite FROM items1view
 WHERE categories_id =$categoryid AND items_id NOT IN  (SELECT items1view.items_id FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid =items1view.items_id AND
 favorite.favorite_usersid = $userid )");

$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
result($count,$data);