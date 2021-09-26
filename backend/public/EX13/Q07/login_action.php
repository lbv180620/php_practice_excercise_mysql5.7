<?php

session_start();

session_regenerate_id();

require_once './class/db/Env.php';
require_once './class/db/Base.php';
require_once './class/db/Users.php';

$_SESSION['login'] = $_POST;

try {
    $db = new Users();

    $user = $db->getUser($_POST['email'], $_POST['password']);

    if (empty($user)) {
        $_SESSION['err']['msg'] = 'メールアドレスまたはパスワードに誤りがあります。';
        header('Location: ./login.php', true, 301);
        exit;
    }

    $_SESSION['user'] = $user;

    unset($_SESSION['err']['msg']);
    header('Location: ./', true, 301);
    exit;
} catch (Exception $e) {
    $_SESSION['err']['msg'] = '申し訳ございません。エラーが発生しました。';
    header('Location: ./login.php', true, 301);
    exit;
}
