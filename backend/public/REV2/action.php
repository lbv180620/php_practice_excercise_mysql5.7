<?php

require_once dirname(__FILE__, 3) . 'vendor/autoload.php';

use Class\config\Config;
use Class\db\TodoItems;
use Class\utils\SaftyUtil;
use Class\utils\SessionUtil;

SessionUtil::sessionStart();

// ログインしていないときは、login.phpへリダイレクト
if (empty($_SESSION['user'])) {
    header('Location: ./login.php', true, 301);
    exit;
}


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
    $_SESSION['err']['msg'] = Config::MSG_PDOEXCEPTION;
    header('Location: ./error.php', true, 301);
    exit;
} catch (Exception $e) {
    $_SESSION['err']['msg'] = Config::MSG_EXCEPTION;
    header('Location: ./error.php', true, 301);
    exit;
} finally {
    $dbh = null;
}
