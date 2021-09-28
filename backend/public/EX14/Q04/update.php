<?php

session_start();
session_regenerate_id();

// ログインしていないときは、login.phpへリダイレクト
if (empty($_SESSION['user'])) {
    header('Location: ./login.php', true, 301);
    exit;
}

require_once './class/db/Env.php';
require_once './class/config/Config.php';
require_once './class/db/Base.php';
require_once './class/db/TodoItems.php';
require_once './class/util/SaftyUtil.php';

// ワンタイムトークンのチェック
if (!SaftyUtil::isValidToken($_POST['token'])) {
    $_SESSION['err']['msg'] = Config::MSG_INVALID_PROCESS;
    header('Location: ./', true, 301);
    exit;
}


try {
    // $_FILESが存在しない、もしくは、アップロード時にエラーが発生したとき
    if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] > 0) {
        throw new Exception(Config::MSG_UPLOAD_FAILURE);
    }

    // アップロードされたCSVファイルを開く
    $fp = @fopen($_FILES['csv_file']['tmp_name'], 'r');
    if (!$fp) {
        throw new Exception(Config::MSG_UPLOAD_FAILURE);
    }

    $dbh = new TodoItems();

    // トランザクション開始
    // 複数のupdateが行われるので、エラーが発生したときにはすべてのトランザクションをロールバックします。
    // アップデートされているレコードとされていないレコードが混在しないようにするためです。
    $dbh->begin();

    // 開いたCSVファイルを1行ずつ読み込む
    while (($buff = fgetcsv($fp)) !== false) {
        //$db->update($buff[0], $buff[1], mb_convert_encoding($buff[2], 'UTF-8', 'SJIS-win'), $buff[3]);
        $dbh->update($buff[0], $buff[1], $buff[2], $buff[3]);
    }

    // トランザクションをコミット
    $dbh->commit();

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
