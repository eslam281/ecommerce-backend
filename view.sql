
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


