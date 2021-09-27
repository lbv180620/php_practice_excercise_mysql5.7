use php_work;

SET @i := 0;
UPDATE todo_items SET id = (@i := @i +1) ;

ALTER TABLE todo_items AUTO_INCREMENT=6;
