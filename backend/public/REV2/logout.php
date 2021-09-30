<?php

require_once dirname(__FILE__, 3) . '/vendor/autoload.php';

use Classes\utils\SessionUtil;

SessionUtil::sessionStart();

// セッションに保存されているユーザー情報を削除する
unset($_SESSION['user']);

// セッションに保存されているログインユーザー名を削除する
unset($_SESSION['login']);

// セッションに保存されているエラーメッセージを削除する
unset($_SESSION['err']['msg']);

header('Location: ./login.php', true, 301);
exit;
