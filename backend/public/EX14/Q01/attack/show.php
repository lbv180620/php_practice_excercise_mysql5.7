<?php

use Dotenv\Dotenv;

require dirname(__FILE__, 5) . '/vendor/autoload.php';

Dotenv::createImmutable(dirname(__FILE__, 6))->load();

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

    // $sql = "select * from todo_items where expiration_date = '{$_POST['date']}'";

    $sql = "select * from todo_items";
    $sql .= " where expiration_date = '{$_POST['date']}'";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $list = $stmt->fetchAll();
} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    exit($e->getMessage() . PHP_EOL);
} finally {
    $dbh = null;
}

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
                        <table class="table table-bordered">
                            <tr>
                                <th>期限日</th>
                                <th>TODO項目</th>
                            </tr>
                            <?php foreach ($list as $rec) : ?>
                                <tr>
                                    <td><?= $rec['expiration_date'] ?></td>
                                    <td><?= $rec['todo_item'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                        <p><?= print_r($sql) ?></p>
                        <a href="./">もどる</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
