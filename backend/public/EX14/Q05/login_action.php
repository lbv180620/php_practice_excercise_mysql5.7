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
    header('Location: ./login.php', true, 301);
    exit;
}

// ログインの情報をセッションに保存する
$_SESSION['login'] = $_POST;

try {
    // ユーザーテーブルクラスのインスタンスを生成する
    $dbh = new Users();

    // ログイン情報からユーザーを検索
    $user = $dbh->getUser($_POST['email'], $_POST['password']);

    // ログイン不可のとき
    if (empty($user)) {
        // エラーメッセージをセッションに保存して、リダイレクトする
        $_SESSION['err']['msg'] = Config::MSG_USER_LOGIN_FAILURE;
        header('Location: ./login.php', true, 301);
        exit;
    }

    // ユーザー情報をセッションに保存する
    $_SESSION['user'] = $user;

    // エラーメッセージを削除して、index.phpにリダイレクト
    unset($_SESSION['err']['msg']);
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
}
