<?php

require_once './class/db/Env.php';
require_once './class/db/Base.php';
require_once './class/db/Users.php';

session_start();

session_regenerate_id();

$_SESSION['login'] = $_POST;

try {
    $db = new Users();

    $ret = $db->addUser($_POST['email'], $_POST['passwd'], $_POST['name']);

    if (!$ret) {
        $_SESSION['err']['msg'] = '既に同じメールアドレスが登録されています。';
        header('Location: ./user_add.php', true, 301);
        exit;
    }

    unset($_POST['login']);
    unset($_['err']['msg']);
    header('Location ./login.php', true, 301);
    exit;
} catch (Exception $e) {
    $_SESSION['err']['msg'] = '申し訳ございません。エラーが発生しました。';
    header('Location: ./user_add.php', true, 301);
    exit;
}
