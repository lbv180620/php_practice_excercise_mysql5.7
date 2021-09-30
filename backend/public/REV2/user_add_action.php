<?php

require_once dirname(__FILE__, 3) . '/vendor/autoload.php';

use Classes\config\Config;
use Classes\db\Users;
use Classes\utils\SaftyUtil;
use Classes\utils\SessionUtil;

SessionUtil::sessionStart();

// ワンタイムトークンのチェック
if (!SaftyUtil::isValidToken($_POST['token'])) {
    $_SESSION['err']['msg'] = Config::MSG_INVALID_PROCESS;
    header('Location: ./user_add.php', true, 301);
    exit;
}

// ログインの情報をセッションに保存する
$_SESSION['login'] = $_POST;

try {
    // ユーザーテーブルクラスのインスタンスを生成する。
    $dbh = new Users();

    // レコードのインサート
    $ret = $dbh->addUser($_POST['email'], $_POST['password'], $_POST['name']);

    if (!$ret) {
        $_SESSION['err']['msg'] = Config::MSG_USER_DUPLICATE;
        header('Location: ./user_add.php', true, 301);
        exit;
    }

    // 正常終了したときは、ログイン情報とエラーメッセージを削除して、index.phpにリダイレクトする。
    // 正常終了した場合は、リダイレクトする前にセッションの状態を一旦リセットする
    unset($_SESSION['login']);
    unset($_SESSION['err']['msg']);
    header('Location ./login.php', true, 301);
    exit;
} catch (PDOException $e) {
    $_SESSION['err']['msg'] = Config::MSG_PDOEXCEPTION;
    header('Location: ./error.php', true, 301);
    exit;
} catch (Exception $e) {
    $_SESSION['err']['msg'] = Config::MSG_EXCEPTION;
    header('Location: ./error.php', true, 301);
    exit;
}
