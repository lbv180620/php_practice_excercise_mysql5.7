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

    $sql = "select * from todo_items order by expiration_date;";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $list = $stmt->fetchAll();
} catch (Exception $e) {
    var_dump($e);
    exit;
} finally {
    $dbh = null;
}

$rename = 'work.download.csv';

header('Content-Type: text/csv');
header("Content-Disposition: attachment; filename='{$rename}'");


foreach ($list as $record) {
    foreach ($record as $k => $v) {
        if ($k == 'todo_item') {
            $record[$k] = mb_convert_encoding($v, 'SJIS-win', 'UTF-8');
        }
    }
    echo implode(',', $record) . "\n";
}

// $file_path = dirname(__FILE__, 4) . '/vagrant_data/work.csv';
// header('Content-Length: ' . filesize($file_path));
