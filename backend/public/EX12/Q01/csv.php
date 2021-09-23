<?php

require_once './class/db/Env.php';
require_once './class/db/Base.php';
require_once './class/db/TodoItems.php';

try {
    $db = new TodoItems();

    $list = $db->selectAll();

} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    exit($e->getMessage() . PHP_EOL);
} finally {
    $dbh = null;
}

$file_name = dirname(__FILE__, 4) . '/vagrant_data/work.csv';
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
