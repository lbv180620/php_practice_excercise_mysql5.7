use php_work;

create table users (
    id int(11) not null primary key auto_increment,
    email varchar(256) not null,
    password varchar(256) not null,
    name varchar(50) not null
    ) engine=innodb default charset=utf8mb4 collate=utf8mb4_general_ci;

show tables;
