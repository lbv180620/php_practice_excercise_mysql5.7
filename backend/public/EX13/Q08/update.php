<?php

session_start();

session_regenerate_id();

require_once './class/db/Env.php';
require_once './class/db/Base.php';
require_once './class/db/TodoItems.php';

if (empty($_SESSION['user'])) {
    header('Location: ./login.php', true, 301);
    exit;
}

try {
    if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] > 0) {
        throw new Exception('アップロードに失敗しました');
    }

    $fp = fopen($_FILES['csv_file']['tmp_name'], 'r');

    $db = new TodoItems();

    while (($buff = fgetcsv($fp)) !== false) {
        //$db->update($buff[0], $buff[1], mb_convert_encoding($buff[2], 'UTF-8', 'SJIS-win'), $buff[3]);
        $db->update($buff[0], $buff[1], $buff[2], $buff[3]);
    }

    header('Location: ./', true, 301);
    exit;
} catch (Exception $e) {
    $msg = $e->getMessage();
    $_SESSION['err']['msg'] = $msg;
    header('Location: ./upload.php', true, 301);
    exit;
} catch (PDOException $e) {
    $msg = 'データベース接続に失敗しました';
    $_SESSION['err']['msg'] = $msg;
    header('Location: ./upload.php', true, 301);
    exit;
} finally {
    $dbh = null;
    fclose($fp);
}
