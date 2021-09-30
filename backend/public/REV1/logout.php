<?php

require_once './class/utils/SessionUtil.php';

SessionUtil::sessionStart();

// セッションに保存されているユーザー情報を削除する
unset($_SESSION['user']);

// セッションに保存されているログインユーザー名を削除する
unset($_SESSION['login']);

// セッションに保存されているエラーメッセージを削除する
unset($_SESSION['err']['msg']);

header('Location: ./login.php', true, 301);
exit;
