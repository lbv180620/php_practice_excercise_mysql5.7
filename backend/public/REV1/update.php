<?php

require_once './class/db/Env.php';
require_once './class/config/Config.php';
require_once './class/db/Base.php';
require_once './class/db/TodoItems.php';
require_once './class/utils/SaftyUtil.php';
require_once './class/utils/SessionUtil.php';

SessionUtil::sessionStart();

// ログインしていないときは、login.phpへリダイレクト
if (empty($_SESSION['user'])) {
    header('Location: ./login.php', true, 301);
    exit;
}


// ワンタイムトークンのチェック
if (!SaftyUtil::isValidToken($_POST['token'])) {
    $_SESSION['err']['msg'] = Config::MSG_INVALID_PROCESS;
    header('Location: ./user_add.php', true, 301);
    exit;
}


try {
    // $_FILESが存在しない、もしくは、アップロード時にエラーが発生したとき
    if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] > 0) {
        $_SESSION['err']['msg'] = Config::MSG_UPLOAD_FAILURE;
        header('Location: ./upload.php', true, 301);
        exit;
    }

    // アップロードされたCSVファイルを開く
    $fp = @fopen($_FILES['csv_file']['tmp_name'], 'r');
    if (!$fp) {
        $_SESSION['err']['msg'] = Config::MSG_UPLOAD_FAILURE;
        header('Location: ./upload.php', true, 301);
        exit;
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
} catch (PDOException $e) {
    // トランザクションをロールバック
    $dbh->rollback();
    $_SESSION['err']['msg'] = Config::MSG_PDOEXCEPTION;
    header('Location: ./error.php', true, 301);
    exit;
} catch (Exception $e) {
    $_SESSION['err']['msg'] = Config::MSG_EXCEPTION;
    header('Location: ./error.php', true, 301);
    exit;
} finally {
    $dbh = null;
    fclose($fp);
}
