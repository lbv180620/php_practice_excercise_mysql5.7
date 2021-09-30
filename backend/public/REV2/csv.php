<?php

require_once dirname(__FILE__, 3) . '/vendor/autoload.php';

use Classes\config\Config;
use Classes\db\TodoItems;
use Classes\utils\SessionUtil;

SessionUtil::sessionStart();

// // ログインしていないときは、login.phpへリダイレクト
if (empty($_SESSION['user'])) {
    header('Location: ./login.php', true, 301);
    exit;
}

// エラーメッセージをクリア
unset($_SESSION['err']['msg']);

try {
    $dbh = new TodoItems();

    $list = $dbh->selectAll();
} catch (PDOException $e) {
    $_SESSION['err']['msg'] = Config::MSG_PDOEXCEPTION;
    header('Location: ./error.php', true, 301);
    exit;
} catch (Exception $e) {
    // エラーメッセージをセッションに保存してエラーページにリダイレクト
    $_SESSION['err']['msg'] = Config::MSG_EXCEPTION;
    header('Location: ./error.php');
    exit;
} finally {
    $dbh = null;
}

// 書き込み成功|失敗フラグ
$b = true;

// CSVファイルを書き込みモードで開く
$file_name = dirname(__FILE__, 4) . '/vagrant_data/work.csv';
$fp = fopen($file_name, 'w');

if (!$fp) {
    $b = false;
} else {
    // 文字列をSJIS-winに変換して、ファイルに書き込む
    foreach ($list as $rec) {
        foreach ($rec as $k => $v) {
            if ($k == 'todo_item') {
                $rec[$k] =  mb_convert_encoding($v, 'sjis-win', 'utf-8');
            }
        }
        if (@fputcsv($fp, $rec, ',', '"') === false) {
            $b = false;
            break;
        }
    }
}

// フラグによる結果判定
if ($b) {
    $msg = '書き込みに成功しました。';
} else {
    $msg = '書き込みに失敗しました。';
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
