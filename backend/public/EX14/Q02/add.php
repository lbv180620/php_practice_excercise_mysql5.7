<?php

if (!function_exists('h')) {
    function h($s)
    {
        return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
    }
}

// $expiration_date = htmlspecialchars($_POST['expiration_date'], ENT_QUOTES, "UTF-8");
// $todo_item = htmlspecialchars($_POST['todo_item'], ENT_QUOTES, "UTF-8");

$expiration_date = h($_POST['expiration_date']);
$todo_item = h($_POST['todo_item']);

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
    $stmt->bindValue(':expiration_date', $expiration_date, PDO::PARAM_STR);
    $stmt->bindValue(':todo_item', $todo_item, PDO::PARAM_STR);
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
