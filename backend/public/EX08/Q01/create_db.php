<?php

use Dotenv\Dotenv;

require dirname(__FILE__, 4) . '/vendor/autoload.php';

Dotenv::createImmutable(dirname(__FILE__, 5))->load();

$dbname = $_ENV['DB_NAME'];
// $dbname = 'php_work';
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$passwd = $_ENV['DB_PASS'];
$dsn = "mysql:dbname = {$dbname};host={$host};charset=utf8";

$driver_opts = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

error_reporting(E_ALL & ~E_NOTICE);

try {
    $dbh = new PDO($dsn, $user, $passwd, $driver_opts);
    echo 'Connected!' . PHP_EOL;
    // $stmt = $dbh->prepare($sql);
    // $stmt->execute();
    $dbh->query("create database if not exists php_work;");
    $dbh->query("use php_work;");
    $dbh->query("
        create table todo_items (
            id int not null auto_increment,
            expiration_date date not null,
            todo_item varchar(100) not null,
            is_completed tinyint default 0 not null,
            primary key(id)
            ) engine=innodb default charset=utf8mb4 collate=utf8mb4_general_ci;
    ");
    $stmt = $dbh->query('describe todo_items;');
    $res = $stmt->fetchAll();
    foreach ($res as $v) {
        print_r($v);
    }
} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    //header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage() . PHP_EOL);
} finally {
    $dsn = null;
}
