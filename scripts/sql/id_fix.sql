use php_work;

SET @i := 0;
UPDATE users SET id = (@i := @i +1) ;

ALTER TABLE users AUTO_INCREMENT=2;
