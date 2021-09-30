<?php

require_once './class/db/Env.php';
require_once './class/config/Config.php';
require_once './class/db/Base.php';
require_once './class/db/TodoItems.php';
require_once './class/utils/SaftyUtil.php';
require_once './class/utils/SessionUtil.php';

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

    $dbh->insert($_POST['expiration_date'], $_POST['todo_item']);

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
