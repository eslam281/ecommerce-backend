
CREATE OR REPLACE VIEW items1view AS
SELECT items.* ,categories.* FROM items
INNER JOIN categories on items.items.items_cat=categories.categories_id;



CREATE OR REPLACE VIEW myfavorite AS
SELECT favorite.*,items.*,users.users_id FROM favorite
INNER JOIN users on favorite.favorite_usersid = users.users_id
INNER JOIN items on favorite.favorite_itemsid = items.items_id


CREATE OR REPLACE VIEW itemsAllImage AS
SELECT items.*,itemimage.* FROM items
INNER JOIN itemimage on itemimage.itemimage_id = items.items_id


CREATE OR REPLACE VIEW cartview AS
SELECT SUM(items.items_price-(items.items_price*items.items_discount/100)) as itemsprice, COUNT(cart_itemsid) AS countitems ,cart.*,items.* FROM `cart` 
INNER JOIN items ON items.items_id = cart_itemsid
where cart.cart_orders = 0
GROUP BY cart.cart_itemsid, cart.cart_usersid ,cart.cart_orders


CREATE OR REPLACE VIEW ordersview AS
SELECT orders.*,address.* ,coupon.* FROM orders
LEFT JOIN address ON address.address_id = orders.orders_address
LEFT JOIN coupon ON coupon.coupon_id = orders.orders_coupon


CREATE OR REPLACE VIEW orderdetailsview AS
SELECT SUM(items.items_price-(items.items_price*items.items_discount/100)) as itemsprice, COUNT(cart_itemsid) AS countitems ,cart.*,items.*FROM `cart` 
INNER JOIN items ON items.items_id = cart_itemsid
where cart.cart_orders != 0
GROUP BY cart.cart_itemsid, cart.cart_usersid ,cart.cart_orders

CREATE or REPLACE VIEW itemstopselling as
SELECT count(cart_id) as countitems,cart.*,items.* FROM `cart` 
INNER JOIN items ON items.items_id = cart_itemsid
WHERE cart_orders != 0 
GROUP by cart_itemsid ORDER BY countitems DESC