create database if not exists php_work;

show databases;

use php_work;

create table todo_items (
    id int not null auto_increment,
    expiration_date date not null,
    todo_item varchar(100) not null,
    is_completed tinyint default 0 not null,
    primary key(id)
    )default charset=utf8mb4 collate=utf8mb4_general_ci;

show tables;
