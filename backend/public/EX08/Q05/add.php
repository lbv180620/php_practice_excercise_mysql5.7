<?php

use Dotenv\Dotenv;

require dirname(__FILE__, 4) . '/vendor/autoload.php';

Dotenv::createImmutable(dirname(__FILE__, 5))->load();

$dbname = 'php_work';
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$passwd = $_ENV['DB_PASS'];

$dns = "mysql:dbname={$dbname};host={$host};charset=utf8";

$driver_opts = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$sql = "insert into todo_items (";
$sql .= "expiration_date,";
$sql .= "todo_item";
$sql .= ") values (";
$sql .= ":expiration_date,";
$sql .= ":todo_item";
$sql .= ");";

try {
    $dbh = new PDO($dns, $user, $passwd, $driver_opts);

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':expiration_date', $_POST['expiration_date'], PDO::PARAM_STR);
    $stmt->bindValue(':todo_item', $_POST['todo_item'], PDO::PARAM_STR);
    $stmt->execute();
    $url = './';
    header('Location: ' . $url, true, 301);
    exit;
} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    exit($e->getMessage() . PHP_EOL);
} finally {
    $dbh = null;
}
