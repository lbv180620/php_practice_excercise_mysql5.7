<?php

session_start();
session_regenerate_id();

// ログインしていないときは、login.phpへリダイレクト
if (empty($_SESSION['user'])) {
    header('Location: ./login.php', true, 301);
    exit;
}

require './class/db/Env.php';
require './class/config/Config.php';
require './class/db/Base.php';
require './class/db/TodoItems.php';
require './class/util/SaftyUtil.php';

// ワンタイムトークンのチェック
if (!SaftyUtil::isValidToken($_POST['token'])) {
    $_SESSION['err']['msg'] = Config::MSG_INVALID_PROCESS;
    header('Location: ./', true, 301);
    exit;
}

// エラーメッセージをクリア
unset($_SESSION['err']['msg']);

try {

    $dbh = new TodoItems();

    // 削除チェックボックスにチェックが入っているとき
    if (isset($_POST['delete']) && $_POST['delete'] == "1") {
        // レコードを削除する
        $dbh->delete($_POST['id']);
    } else {
        // レコードをアップデードする
        $dbh->updateIsCompletedByID($_POST['id'], $_POST['is_completed']);
    }

    header('Location: ./', true, 301);
    exit;
} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    exit($e->getMessage() . PHP_EOL);
} finally {
    $dbh = null;
}
