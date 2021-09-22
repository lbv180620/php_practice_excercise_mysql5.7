<?php

session_start();

session_regenerate_id();

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
    if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] > 0) {
        throw new Exception('アップロードに失敗しました');
    }

    $fp = fopen($_FILES['csv_file']['tmp_name'], 'r');

    $dbh = new PDO($dsn, $user, $passwd, $driver_opts);

    $sql = "update todo_items set expiration_date = :expiration_date, todo_item = :todo_item, is_completed = :is_completed where id = :id;";

    $stmt = $dbh->prepare($sql);

    while (($buff = fgetcsv($fp)) !== false) {
        $stmt->bindValue(':id', $buff[0], PDO::PARAM_INT);
        $stmt->bindValue(':expiration_date', $buff[1], PDO::PARAM_STR);
        $stmt->bindValue(':todo_item', $buff[2], PDO::PARAM_STR);
        $stmt->bindValue(':is_completed', $buff[3], PDO::PARAM_INT);

        $stmt->execute();
    }

    header('Location: ./', true, 301);
    exit;
} catch (Exception $e) {
    $msg = $e->getMessage();
    $_SESSION['err']['msg'] = $msg;
    header('Location: ./upload.php', true, 301);
    exit;
} catch (PDOException $e) {
    $msg = 'データベース接続に失敗しました';
    $_SESSION['err']['msg'] = $msg;
    header('Location: ./upload.php', true, 301);
    exit;
} finally {
    $dbh = null;
    fclose($fp);
}
