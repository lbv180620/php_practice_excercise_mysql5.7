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
    header('Location: ./login.php', true, 301);
    exit;
}

// ブルートフォースアタック対策
// ログイン3回失敗でログインできないようにする
// /tmpにあるセッションファイルが消えない限り、ずっとlogin_failure >= 3なのでログインできない
if (isset($_SESSION['login_failure']) && $_SESSION['login_failure'] >= 3) {
    $_SESSION['err']['msg'] = Config::MSG_USER_LOGIN_TRY_TIMES_OVER;
    header('Location: ./error.php', true, 301);
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
        // ログイン失敗回数をセッションに保存
        if (isset($_SESSION['login_failure'])) {
            $_SESSION['login_failure']++;
        } else {
            $_SESSION['login_failure'] = 1;
        }
        // エラーメッセージをセッションに保存して、リダイレクトする
        $_SESSION['err']['msg'] = Config::MSG_USER_LOGIN_FAILURE;
        header('Location: ./login.php', true, 301);
        exit;
    }

    // ログインに成功した場合、ログイン失敗回数をリセット
    unset($_SESSION['login_failure']);

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
