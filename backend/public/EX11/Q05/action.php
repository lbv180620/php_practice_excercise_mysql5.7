<?php

use Dotenv\Dotenv;

require dirname(__FILE__, 4) . '/vendor/autoload.php';

Dotenv::createImmutable(dirname(__FILE__, 5))->load();

$dbname = 'php_work';
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$passwd = $_ENV['DB_PASS'];

$dsn = "mysql:dbname={$dbname};host={$host};charset=utf8";

$driver_opts = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];


try {
    $dbh = new PDO($dsn, $user, $passwd, $driver_opts);

    if (isset($_POST['delete']) && $_POST['delete'] == "1") {
        $sql = 'delete from todo_items where id = :id;';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
    } else {
        $sql = 'update todo_items set is_completed = :is_completed where id = :id;';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        $stmt->bindValue(':is_completed', $_POST['is_completed'], PDO::PARAM_INT);
    }

    $stmt->execute();

    $url = './';
    header('Location: ' . $url, true, 301);
    exit;
} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    print_r($_POST);
    exit($e->getMessage() . PHP_EOL);
} finally {
    $dbh = null;
}
