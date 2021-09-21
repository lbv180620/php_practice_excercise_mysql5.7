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
} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    exit($e->getMessage() . PHP_EOL);
} finally {
    $dbh = null;
}

$file_name = dirname(__FILE__, 4) . '/share/work.csv';
$fp = fopen($file_name, 'w');

if ($fp) {
    foreach ($list as $record) {
        foreach ($record as $k => $v) {
            if ($k == 'todo_item') {
                $record[$k] =  mb_convert_encoding($v, 'sjis-win', 'utf-8');
            }
        }
        if (fputcsv($fp, $record, ',', '"') === false) {
            $msg = '書き込みに失敗しました。';
        } else {
            $msg = '書き込みに成功しました。';
        }
    }
}

fclose($fp);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <?= $msg ?>
                        <a href="./">もどる</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
