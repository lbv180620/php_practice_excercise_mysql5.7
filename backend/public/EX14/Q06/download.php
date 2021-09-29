<?php

session_start();
session_regenerate_id();

// ログインしていないときは、login.phpへリダイレクト
if (empty($_SESSION['user'])) {
    header('Location: ./login.php', true, 301);
    exit;
}

require_once './class/db/Env.php';
require_once './class/config/Config.php';
require_once './class/db/Base.php';
require_once './class/db/TodoItems.php';

// エラーメッセージを一旦リセット
unset($_SESSION['err']['msg']);

try {

    $dbh = new TodoItems();

    $list = $dbh->selectAll();
} catch (Exception $e) {
    $_SESSION['err']['msg'] = Config::MSG_EXCEPTION;
    header('Location: ./error.php');
    exit;
} finally {
    $dbh = null;
}

//// 取得したレコードをCSVファイルとしてダウンロードさせる
$rename = 'work.download.csv';
// $file_path = dirname(__FILE__, 4) . '/vagrant_data/work.csv';

header('Content-Type: text/csv');
// header('Content-Length: ' . filesize($file_path));
header("Content-Disposition: attachment; filename='{$rename}'");


foreach ($list as $rec) {
    // Excel使う場合
    // foreach ($rec as $k => $v) {
    //     if ($k == 'todo_item') {
    //         $rec[$k] = mb_convert_encoding($v, 'SJIS-win', 'UTF-8');
    //     }
    // }

    // 配列を「,」で結合して出力する
    echo implode(',', $rec) . "\n";
}
