<?php

session_start();
session_regenerate_id();

require_once './class/db/Env.php';
require_once './class/config/Config.php';
require_once './class/db/Base.php';
require_once './class/db/Users.php';
require_once './class/util/SaftyUtil.php';

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
